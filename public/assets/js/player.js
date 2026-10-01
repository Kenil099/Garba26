/**
 * public/assets/js/player.js
 * Garba26 - High Fidelity Audio Engine + Live Garba Dhol Synthesizer + YouTube Stream Integration
 */

const GarbaPlayer = (function() {
    let currentTrack = null;
    let isPlaying = false;
    let audio = new Audio();
    let songsList = [];
    let queue = [];
    let currentIndex = 0;
    let isShuffle = false;

    // YouTube Player State
    let ytPlayer = null;
    let isYtReady = false;
    let ytProgressTimer = null;
    let pendingYtPlay = false;

    // Background Themes mapping
    const genreThemes = {
        'folk': '/assets/backgrounds/folk-courtyard.webp',
        'traditional': '/assets/backgrounds/master-dark.webp',
        'dandiya': '/assets/backgrounds/dandiya-silhouette.webp',
        'devotional': '/assets/backgrounds/devotional.webp',
        'sanedo': '/assets/backgrounds/colourful.webp',
        'fusion': '/assets/backgrounds/fusion.webp',
        'nonstop': '/assets/backgrounds/folk-courtyard.webp'
    };

    // Web Audio Synthesizer Context
    let audioCtx = null;
    let synthTimer = null;
    let synthStep = 0;
    let synthBpm = 118;
    let isSynthEnabled = true;

    // Helper: Parse YouTube Video ID from any format
    function parseYouTubeId(url) {
        if (!url) return null;
        const trimmed = url.trim();
        if (trimmed.length === 11 && /^[a-zA-Z0-9_-]{11}$/.test(trimmed)) {
            return trimmed;
        }
        const match = trimmed.match(/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/);
        return match ? match[1] : null;
    }

    // Initialize YouTube IFrame Player
    function initYouTube() {
        if (window.YT && window.YT.Player) {
            setupYouTubePlayer();
        } else {
            window.onYouTubeIframeAPIReady = function() {
                setupYouTubePlayer();
            };
        }
    }

    function setupYouTubePlayer() {
        if (ytPlayer) return;
        try {
            ytPlayer = new YT.Player('ytPlayerEmbed', {
                height: '100%',
                width: '100%',
                videoId: 'MASCw3qDBsQ',
                playerVars: {
                    autoplay: 0,
                    controls: 1,
                    modestbranding: 1,
                    rel: 0,
                    playsinline: 1,
                    enablejsapi: 1,
                    origin: window.location.origin
                },
                events: {
                    'onReady': onYtReady,
                    'onStateChange': onYtStateChange,
                    'onError': onYtError
                }
            });
        } catch (e) {
            console.warn('YouTube IFrame player initialization warning:', e);
        }
    }

    function onYtReady() {
        isYtReady = true;
        if (pendingYtPlay && currentTrack && currentTrack.isYouTube) {
            pendingYtPlay = false;
            play();
        }
    }

    function onYtStateChange(event) {
        const app = document.getElementById('garbaApp');
        const streamingVia = document.getElementById('streamingVia');

        if (event.data === YT.PlayerState.PLAYING) {
            isPlaying = true;
            if (app) app.classList.add('is-playing');
            if (streamingVia) streamingVia.classList.add('is-streaming');
            startYtProgressTracker();
        } else if (event.data === YT.PlayerState.PAUSED) {
            isPlaying = false;
            if (app) app.classList.remove('is-playing');
            stopYtProgressTracker();
        } else if (event.data === YT.PlayerState.ENDED) {
            isPlaying = false;
            if (app) app.classList.remove('is-playing');
            stopYtProgressTracker();
            playNext();
        }
    }

    function onYtError(event) {
        console.warn('YouTube player error code:', event.data);
        GarbaToast.show('Streaming note: YouTube source loaded');
    }

    function startYtProgressTracker() {
        stopYtProgressTracker();
        ytProgressTimer = setInterval(() => {
            if (!ytPlayer || !ytPlayer.getCurrentTime) return;
            const cur = ytPlayer.getCurrentTime() || 0;
            const dur = (ytPlayer.getDuration && ytPlayer.getDuration() > 0) 
                        ? ytPlayer.getDuration() 
                        : (currentTrack ? currentTrack.duration : 1845);

            document.getElementById('elapsedTime').textContent = formatTime(cur);
            document.getElementById('durationTime').textContent = formatTime(dur);

            const slider = document.getElementById('progress');
            if (slider && dur > 0) {
                slider.value = (cur / dur) * 1000;
            }
        }, 350);
    }

    function stopYtProgressTracker() {
        if (ytProgressTimer) {
            clearInterval(ytProgressTimer);
            ytProgressTimer = null;
        }
    }

    // Web Audio Synthesizer
    function initAudioContext() {
        if (!audioCtx) {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            audioCtx = new AudioContext();
        }
        if (audioCtx.state === 'suspended') {
            audioCtx.resume();
        }
    }

    function playGarbaDhol(type = 'bass', time = 0) {
        if (!audioCtx || !isSynthEnabled) return;
        const now = time || audioCtx.currentTime;

        if (type === 'bass') {
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(140, now);
            osc.frequency.exponentialRampToValueAtTime(45, now + 0.18);
            gain.gain.setValueAtTime(0.55, now);
            gain.gain.exponentialRampToValueAtTime(0.001, now + 0.22);
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.start(now);
            osc.stop(now + 0.22);
        } else if (type === 'clap') {
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.type = 'triangle';
            osc.frequency.setValueAtTime(420, now);
            osc.frequency.exponentialRampToValueAtTime(180, now + 0.08);
            gain.gain.setValueAtTime(0.32, now);
            gain.gain.exponentialRampToValueAtTime(0.001, now + 0.1);
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.start(now);
            osc.stop(now + 0.1);
        } else if (type === 'dandiya') {
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(980, now);
            osc.frequency.exponentialRampToValueAtTime(650, now + 0.05);
            gain.gain.setValueAtTime(0.25, now);
            gain.gain.exponentialRampToValueAtTime(0.001, now + 0.06);
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.start(now);
            osc.stop(now + 0.06);
        }
    }

    function startGarbaSynth() {
        if (synthTimer) clearInterval(synthTimer);
        initAudioContext();
        synthStep = 0;
        const interval = (60 / synthBpm) * 1000 / 2;

        synthTimer = setInterval(() => {
            if (!isPlaying) return;
            if (synthStep === 0) {
                playGarbaDhol('bass');
            } else if (synthStep === 2) {
                playGarbaDhol('clap');
            } else if (synthStep === 4) {
                playGarbaDhol('bass');
                playGarbaDhol('dandiya');
            } else if (synthStep === 6) {
                playGarbaDhol('clap');
            }
            synthStep = (synthStep + 1) % 8;
        }, interval);
    }

    function stopGarbaSynth() {
        if (synthTimer) {
            clearInterval(synthTimer);
            synthTimer = null;
        }
    }

    function init() {
        initYouTube();
        fetchSongsAndBoot();
        bindAudioEvents();
        setupKeyboardShortcuts();
    }

    function fetchSongsAndBoot() {
        fetch('/api/songs/list')
            .then(res => res.json())
            .then(data => {
                if (data.success && data.data && data.data.length > 0) {
                    songsList = data.data;
                    queue = [...songsList];
                    
                    // Check URL params for explicit song selection (e.g. ?song=MASCw3qDBsQ or ?yt=MASCw3qDBsQ)
                    const params = new URLSearchParams(window.location.search);
                    const ytParam = params.get('yt') || params.get('song');
                    
                    let initialTrack = null;
                    if (ytParam) {
                        const parsedId = parseYouTubeId(ytParam);
                        initialTrack = songsList.find(s => 
                            (parsedId && (s.youtube_id === parsedId || (s.audio_url && s.audio_url.includes(parsedId)))) ||
                            s.slug === ytParam ||
                            s.title.toLowerCase().includes(ytParam.toLowerCase())
                        );
                    }

                    // Default to the requested YouTube track or featured song
                    if (!initialTrack) {
                        initialTrack = songsList.find(s => s.youtube_id === 'MASCw3qDBsQ') ||
                                       songsList.find(s => s.title.includes('Aditya Gadhvi')) ||
                                       songsList.find(s => s.title.includes('Mitha Moraliya')) ||
                                       songsList[0];
                    }

                    setTrack(initialTrack);
                    renderQueueList();
                    renderPresetYtList();
                }
            })
            .catch(() => {
                // Fallback default YouTube song
                setTrack({
                    id: 17,
                    title: 'Best of Aditya Gadhvi Non stop',
                    artist_name: 'Aditya Gadhvi',
                    style: 'Nonstop',
                    duration: 1845,
                    youtube_id: 'MASCw3qDBsQ',
                    audio_url: 'https://youtu.be/MASCw3qDBsQ'
                });
            });
    }

    function bindAudioEvents() {
        audio.addEventListener('timeupdate', () => {
            if (currentTrack && currentTrack.isYouTube) return;
            const cur = audio.currentTime;
            const dur = audio.duration || (currentTrack ? currentTrack.duration : 267);
            document.getElementById('elapsedTime').textContent = formatTime(cur);
            document.getElementById('durationTime').textContent = formatTime(dur);
            const slider = document.getElementById('progress');
            if (slider && dur > 0) {
                slider.value = (cur / dur) * 1000;
            }
        });

        audio.addEventListener('ended', playNext);
    }

    function setTrack(song) {
        currentTrack = song;

        // Check if track is a YouTube stream
        const ytId = song.youtube_id || parseYouTubeId(song.audio_url);
        currentTrack.youtube_id = ytId;
        currentTrack.isYouTube = Boolean(ytId);

        document.getElementById('songTitle').textContent = song.title;
        document.getElementById('songArtist').textContent = song.artist_name || 'Garba Maestro';
        document.getElementById('genreEyebrow').textContent = (song.style || 'Folk') + ' Garba';
        document.getElementById('durationTime').textContent = formatTime(song.duration || 267);
        document.getElementById('elapsedTime').textContent = '0:00';
        document.getElementById('progress').value = 0;

        const streamingVia = document.getElementById('streamingVia');

        if (currentTrack.isYouTube) {
            audio.pause();
            audio.src = '';
            stopGarbaSynth();
            if (streamingVia) streamingVia.classList.add('is-streaming');

            if (isYtReady && ytPlayer && ytPlayer.cueVideoById) {
                try {
                    ytPlayer.cueVideoById(currentTrack.youtube_id);
                } catch (e) {
                    console.warn('cueVideoById error:', e);
                }
            }
        } else {
            if (streamingVia) streamingVia.classList.remove('is-streaming');
            if (isYtReady && ytPlayer && ytPlayer.pauseVideo) {
                ytPlayer.pauseVideo();
            }
            if (song.audio_url && song.audio_url.length > 5 && !song.audio_url.includes('youtu')) {
                audio.src = song.audio_url;
                stopGarbaSynth();
            } else {
                audio.src = '';
            }
        }

        // Highlight matching genre button if any
        highlightGenre(song.style ? song.style.toLowerCase() : 'folk');
    }

    function play() {
        initAudioContext();
        isPlaying = true;
        const app = document.getElementById('garbaApp');
        if (app) app.classList.add('is-playing');

        if (currentTrack && currentTrack.isYouTube) {
            audio.pause();
            stopGarbaSynth();

            if (isYtReady && ytPlayer && ytPlayer.playVideo) {
                try {
                    const currentVid = (ytPlayer.getVideoData && ytPlayer.getVideoData().video_id) || '';
                    if (currentVid !== currentTrack.youtube_id) {
                        ytPlayer.loadVideoById(currentTrack.youtube_id);
                    } else {
                        ytPlayer.playVideo();
                    }
                    startYtProgressTracker();
                } catch (e) {
                    console.warn('YouTube playVideo error:', e);
                }
            } else {
                pendingYtPlay = true;
                GarbaToast.show('Connecting to YouTube audio stream...');
            }
        } else if (audio.src && audio.src !== window.location.href) {
            audio.play().catch(() => {});
        } else {
            startGarbaSynth();
        }
    }

    function pause() {
        isPlaying = false;
        const app = document.getElementById('garbaApp');
        if (app) app.classList.remove('is-playing');

        if (currentTrack && currentTrack.isYouTube) {
            if (isYtReady && ytPlayer && ytPlayer.pauseVideo) {
                ytPlayer.pauseVideo();
            }
            stopYtProgressTracker();
        } else {
            audio.pause();
            stopGarbaSynth();
        }
    }

    function togglePlay() {
        if (!currentTrack && songsList.length > 0) {
            setTrack(songsList[0]);
        }
        isPlaying ? pause() : play();
    }

    function playNext() {
        if (queue.length === 0) return;
        currentIndex = (currentIndex + 1) % queue.length;
        setTrack(queue[currentIndex]);
        play();
    }

    function playPrev() {
        if (queue.length === 0) return;
        currentIndex = (currentIndex - 1 + queue.length) % queue.length;
        setTrack(queue[currentIndex]);
        play();
    }

    function playSongById(id) {
        const found = songsList.find(s => s.id == id);
        if (found) {
            setTrack(found);
            play();
            GarbaToast.show(`Playing: ${found.title}`);
        }
    }

    function playSongByYouTubeId(ytId, title, artist) {
        const found = songsList.find(s => s.youtube_id === ytId || (s.audio_url && s.audio_url.includes(ytId)));
        if (found) {
            setTrack(found);
            play();
            GarbaToast.show(`Streaming: ${found.title}`);
            return;
        }
        const song = {
            id: 9999,
            title: title || 'YouTube Garba Stream',
            artist_name: artist || 'Garba Maestro',
            style: 'Folk',
            duration: 300,
            youtube_id: ytId,
            audio_url: `https://youtu.be/${ytId}`
        };
        setTrack(song);
        play();
        GarbaToast.show(`Streaming YouTube: ${song.title}`);
    }

    function onSeek(val) {
        const percent = val / 1000;
        if (currentTrack && currentTrack.isYouTube) {
            const dur = (ytPlayer && ytPlayer.getDuration && ytPlayer.getDuration() > 0) 
                        ? ytPlayer.getDuration() 
                        : (currentTrack.duration || 1845);
            const targetTime = percent * dur;
            if (ytPlayer && ytPlayer.seekTo) {
                ytPlayer.seekTo(targetTime, true);
            }
            document.getElementById('elapsedTime').textContent = formatTime(targetTime);
        } else {
            const dur = audio.duration || (currentTrack ? currentTrack.duration : 267);
            const targetTime = percent * dur;
            if (audio.duration) {
                audio.currentTime = targetTime;
            } else {
                document.getElementById('elapsedTime').textContent = formatTime(targetTime);
            }
        }
    }

    function selectGenre(genreKey) {
        highlightGenre(genreKey);

        // Switch background courtyard
        const bgUrl = genreThemes[genreKey] || genreThemes['folk'];
        const layer = document.getElementById('worldLayer');
        if (layer) {
            layer.style.opacity = '0';
            setTimeout(() => {
                layer.style.backgroundImage = `url('${bgUrl}')`;
                layer.style.opacity = '1';
            }, 250);
        }

        // Special match for Nonstop: Aditya Gadhvi Non stop
        if (genreKey === 'nonstop') {
            const nonstopSong = songsList.find(s => s.youtube_id === 'MASCw3qDBsQ' || (s.style && s.style.toLowerCase() === 'nonstop'));
            if (nonstopSong) {
                setTrack(nonstopSong);
                play();
                GarbaToast.show('Nonstop Category: Playing Aditya Gadhvi Non Stop!');
                return;
            }
        }

        // Filter and play top track of that category
        const match = songsList.find(s => 
            (s.style || '').toLowerCase().includes(genreKey.toLowerCase()) ||
            (s.tradition || '').toLowerCase().includes(genreKey.toLowerCase()) ||
            (genreKey === 'dandiya' && ((s.style || '').toLowerCase() === 'raas' || (s.style || '').toLowerCase().includes('dandiya'))) ||
            (genreKey === 'devotional' && ((s.style || '').toLowerCase().includes('aradhiya') || (s.tradition || '').toLowerCase().includes('stuti')))
        );
        if (match) {
            setTrack(match);
            play();
            GarbaToast.show(`${genreKey.toUpperCase()} category selected!`);
        }
    }

    function highlightGenre(genreKey) {
        document.querySelectorAll('.genre-button').forEach(btn => {
            if (btn.getAttribute('data-genre') === genreKey) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    }

    function toggleFavorite() {
        const btn = document.getElementById('favouriteButton');
        if (btn) {
            btn.classList.toggle('active');
            const isFav = btn.classList.contains('active');
            btn.style.color = isFav ? '#d6b06f' : 'inherit';
            GarbaToast.show(isFav ? 'Added to My Garba ❤️' : 'Removed from favourites');
        }
    }

    function toggleShuffle() {
        isShuffle = !isShuffle;
        const btn = document.getElementById('shuffleButton');
        if (btn) {
            btn.style.color = isShuffle ? '#d6b06f' : 'inherit';
            GarbaToast.show(isShuffle ? 'Shuffle Enabled' : 'Shuffle Disabled');
        }
    }

    function toggleLiveRadio() {
        // Find Nonstop Aditya Gadhvi live track
        const liveTrack = songsList.find(s => s.youtube_id === 'MASCw3qDBsQ') || songsList[0];
        if (liveTrack) {
            setTrack(liveTrack);
            play();
            GarbaToast.show("Tuned into 24/7 Live Nonstop Garba Radio 📻", "success");
        }
    }

    function toggleSynth() {
        isSynthEnabled = !isSynthEnabled;
        GarbaToast.show(`Live Dhol Synthesizer ${isSynthEnabled ? 'Enabled' : 'Disabled'}`);
        if (isPlaying && isSynthEnabled && (!audio.src || audio.src === window.location.href)) {
            startGarbaSynth();
        } else {
            stopGarbaSynth();
        }
    }

    function toggleTheme() {
        const themes = Object.values(genreThemes);
        const randomTheme = themes[Math.floor(Math.random() * themes.length)];
        const layer = document.getElementById('worldLayer');
        if (layer) {
            layer.style.backgroundImage = `url('${randomTheme}')`;
            GarbaToast.show('Switched Courtyard Theme!');
        }
    }

    function toggleYtVideo() {
        const container = document.getElementById('ytStreamContainer');
        if (container) {
            container.classList.toggle('is-minimized');
            const isMin = container.classList.contains('is-minimized');
            GarbaToast.show(isMin ? 'Video minimized (Audio mode)' : 'YouTube video stage active');
        }
    }

    function playCustomUrl() {
        const input = document.getElementById('customAudioUrl');
        const url = input ? input.value.trim() : '';
        if (!url) return;

        const ytId = parseYouTubeId(url);
        if (ytId) {
            playSongByYouTubeId(ytId, 'Custom YouTube Stream', 'Live Audio');
        } else {
            setTrack({
                id: 999,
                title: 'Custom Stream',
                artist_name: 'Live Stream',
                style: 'Stream',
                duration: 360,
                audio_url: url
            });
            play();
            GarbaToast.show('Streaming custom audio link!');
        }
        closeLinkSongModal();
    }

    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
    }

    function renderQueueList() {
        const badge = document.getElementById('queueBadge');
        if (badge) {
            badge.textContent = queue.length;
            badge.classList.add('show');
        }
        const container = document.getElementById('queueList');
        if (!container) return;
        container.innerHTML = queue.map((s, idx) => {
            const isYt = Boolean(s.youtube_id || (s.audio_url && s.audio_url.includes('youtu')));
            return `
                <div class="drawer-song-row" onclick="GarbaPlayer.playSongById(${s.id}); closeQueueModal();">
                    <span style="color:#d6b06f; font-weight:700;">#${idx + 1}</span>
                    <div class="drawer-song-info">
                        <strong>${s.title} ${isYt ? '<span class="yt-badge-tag">▶ YouTube</span>' : ''}</strong>
                        <small>${s.artist_name || ''}</small>
                    </div>
                </div>
            `;
        }).join('');
    }

    function renderPresetYtList() {
        const container = document.getElementById('presetYtList');
        if (!container) return;
        const ytSongs = songsList.filter(s => s.youtube_id || (s.audio_url && s.audio_url.includes('youtu')));
        if (ytSongs.length === 0) return;
        
        const header = document.getElementById('presetYtHeader');
        if (header) {
            header.textContent = `FEATURED YOUTUBE STREAMS (${ytSongs.length}):`;
        }
        
        container.innerHTML = ytSongs.map(s => {
            return `
                <button type="button" class="quick-preset-chip" onclick="GarbaPlayer.playSongById(${s.id}); closeLinkSongModal();" style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap; margin-right:8px;">
                        <strong style="color:var(--gold);">▶</strong> <strong>${s.title}</strong>
                        <span style="font-size:0.75rem; color:var(--muted); margin-left:4px;">• ${s.artist_name || ''}</span>
                    </span>
                    <span class="yt-badge-tag" style="white-space:nowrap; flex-shrink:0;">${formatTime(s.duration || 240)}</span>
                </button>
            `;
        }).join('');
    }

    function onQuickSearch(query) {
        const container = document.getElementById('quickSearchResults');
        if (!container) return;
        const term = query.toLowerCase().trim();
        if (!term) {
            container.innerHTML = '<div style="color:var(--muted); padding:12px; text-align:center; font-size:0.85rem;">Type above to search all Garba songs and artists</div>';
            return;
        }
        const matches = songsList.filter(s => 
            s.title.toLowerCase().includes(term) || 
            (s.artist_name && s.artist_name.toLowerCase().includes(term)) ||
            (s.style && s.style.toLowerCase().includes(term))
        ).slice(0, 8);

        if (matches.length === 0) {
            container.innerHTML = '<div style="color:var(--muted); padding:12px; text-align:center; font-size:0.85rem;">No matching Garba songs found</div>';
            return;
        }

        container.innerHTML = matches.map(s => {
            const isYt = Boolean(s.youtube_id || (s.audio_url && s.audio_url.includes('youtu')));
            return `
                <div class="search-result-row" onclick="GarbaPlayer.playSongById(${s.id}); closeSearchModal();" style="display:flex; align-items:center; justify-content:space-between; padding:10px 14px; margin-bottom:6px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.06); border-radius:8px; cursor:pointer;">
                    <div>
                        <strong style="color:var(--ivory); font-size:0.9rem;">${s.title} ${isYt ? '<span class="yt-badge-tag">▶ YouTube</span>' : ''}</strong>
                        <div style="color:var(--muted); font-size:0.75rem;">${s.artist_name || ''} • ${s.style || ''}</div>
                    </div>
                    <span style="color:#d6b06f; font-size:1.1rem;">▶</span>
                </div>
            `;
        }).join('');
    }

    function setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
            if (e.code === 'Space') {
                e.preventDefault();
                togglePlay();
            } else if (e.key === 's' || e.key === 'S') {
                toggleShuffle();
            } else if (e.key === 'f' || e.key === 'F') {
                toggleFavorite();
            } else if (e.key === '/') {
                e.preventDefault();
                openSearchModal();
            }
        });
    }

    return {
        init,
        playSongById,
        playSongByYouTubeId,
        togglePlay,
        playNext,
        playPrev,
        onSeek,
        selectGenre,
        toggleFavorite,
        toggleShuffle,
        toggleLiveRadio,
        toggleSynth,
        toggleTheme,
        toggleYtVideo,
        playCustomUrl,
        onQuickSearch,
        renderPresetYtList
    };
})();

// Modal helper functions
function openSearchModal() {
    const modal = document.getElementById('searchModal');
    if (modal) {
        modal.classList.add('open');
        const input = document.getElementById('quickSearchInput');
        if (input) {
            input.value = '';
            setTimeout(() => input.focus(), 150);
        }
        GarbaPlayer.onQuickSearch('');
    }
}
function closeSearchModal() {
    const modal = document.getElementById('searchModal');
    if (modal) modal.classList.remove('open');
}

function openCircleModal() { document.getElementById('circleModal').classList.add('open'); }
function closeCircleModal() { document.getElementById('circleModal').classList.remove('open'); }

function openQueueModal() { document.getElementById('queueModal').classList.add('open'); }
function closeQueueModal() { document.getElementById('queueModal').classList.remove('open'); }

function openFavouritesModal() { document.getElementById('favouritesModal').classList.add('open'); }
function closeFavouritesModal() { document.getElementById('favouritesModal').classList.remove('open'); }

function openLinkSongModal() { document.getElementById('linkSongModal').classList.add('open'); }
function closeLinkSongModal() { document.getElementById('linkSongModal').classList.remove('open'); }

function openMoreModal() { document.getElementById('moreModal').classList.add('open'); }
function closeMoreModal() { document.getElementById('moreModal').classList.remove('open'); }

function toggleFullScreen() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch(() => {});
    } else {
        if (document.exitFullscreen) document.exitFullscreen();
    }
}

document.addEventListener('DOMContentLoaded', GarbaPlayer.init);
