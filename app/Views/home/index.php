<?php
// app/Views/home/index.php - PlayGarba Immersive Courtyard Theme for Garba26
?>
<div class="app" id="garbaApp">
    <!-- Cinematic Palace Courtyard Background -->
    <div class="world" id="world">
        <div class="world-layer is-visible" id="worldLayer" style="background-image: url('/assets/backgrounds/folk-courtyard.webp');"></div>
        <div class="world-vignette"></div>
        <div class="world-ambient" id="worldAmbient"></div>
    </div>

    <!-- Top Navigation Bar -->
    <header class="topbar">
        <a href="/" class="brand" aria-label="Garba26 Home">Garba26</a>

        <nav class="utilities" aria-label="Player tools">
            <span class="network-status" id="networkStatus" title="Connected"></span>
            
            <!-- Link/YouTube Song -->
            <button class="icon-button" id="linkSongButton" type="button" aria-label="Play YouTube link" title="Play YouTube or Custom Stream" onclick="openLinkSongModal()">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            </button>

            <!-- Search -->
            <button class="icon-button" id="searchButton" type="button" aria-label="Search songs" title="Search songs (/)" onclick="openSearchModal()">
                <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="6.5"></circle><path d="m16 16 5 5"></path></svg>
            </button>

            <!-- Circle / Listen with friends -->
            <button class="icon-button" id="circleButton" type="button" aria-label="Private Garba Circle" title="Private Garba Circle: listen with friends in sync" onclick="openCircleModal()">
                <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="4.2" r="1.7"></circle><circle cx="18.75" cy="8.1" r="1.7"></circle><circle cx="18.75" cy="15.9" r="1.7"></circle><circle cx="12" cy="19.8" r="1.7"></circle><circle cx="5.25" cy="15.9" r="1.7"></circle><circle cx="5.25" cy="8.1" r="1.7"></circle><circle cx="12" cy="12" r="1.2"></circle></svg>
            </button>

            <!-- Liked / Favourites -->
            <button class="icon-button desktop-only" id="favouritesButton" type="button" aria-label="Open My Garba" title="Liked Songs" onclick="openFavouritesModal()">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.9a5.5 5.5 0 0 0-7.8 0L12 5.9l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.3 1-1a5.5 5.5 0 0 0 0-7.8Z"></path></svg>
            </button>

            <!-- Queue with Badge -->
            <button class="icon-button has-badge" id="queueButton" type="button" aria-label="Show queue" title="Up next" onclick="openQueueModal()">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6h11M4 12h11M4 18h7"></path><path d="M18 13v7M18 13l3 2"></path></svg>
                <span class="utility-badge show" id="queueBadge">17</span>
            </button>

            <!-- More Menu -->
            <button class="icon-button more-button" id="moreButton" type="button" aria-label="More" title="More Options" onclick="openMoreModal()">
                <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="5.5" cy="12" r="1.4"></circle><circle cx="12" cy="12" r="1.4"></circle><circle cx="18.5" cy="12" r="1.4"></circle></svg>
            </button>

            <!-- Home & Fullscreen Controls -->
            <div class="view-switch-cluster">
                <button type="button" class="view-btn" onclick="location.href='/'" title="Home View">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-6v-7h-4v7H4a1 1 0 0 1-1-1z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button type="button" class="view-btn" id="fsToggleBtn" onclick="toggleFullScreen()" title="Toggle Fullscreen">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 3H5a2 2 0 0 0-2 2v3m13-5h3a2 2 0 0 1 2 2v3M3 16v3a2 2 0 0 0 2 2h3m13-5v3a2 2 0 0 1-2 2h-3" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        </nav>
    </header>

    <!-- Center Stage Floating Media Player -->
    <main class="player-shell" id="mainPlayer">
        <!-- Floating Title & Artist -->
        <section class="track-block" id="trackBlock">
            <p class="genre-eyebrow" id="genreEyebrow">Folk Garba</p>
            <h1 class="song-title" id="songTitle">Mitha Moraliya</h1>
            <div class="artist-row">
                <p class="artist" id="songArtist">Kirtidan Gadhvi</p>
            </div>
        </section>

        <!-- Transport Buttons -->
        <section class="controls" aria-label="Playback controls">
            <button class="transport shuffle-button" id="shuffleButton" type="button" aria-label="Toggle shuffle" title="Shuffle songs (S)" onclick="GarbaPlayer.toggleShuffle()">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 3h5v5M4 20l17-17M21 16v5h-5M15 15l6 6M4 4l5 5"></path></svg>
            </button>
            
            <button class="transport" id="prevButton" type="button" aria-label="Previous song" title="Previous song" onclick="GarbaPlayer.playPrev()">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 5v14M19 6l-9 6 9 6Z"></path></svg>
            </button>
            
            <button class="play-button" id="playButton" type="button" aria-label="Play / Pause" onclick="GarbaPlayer.togglePlay()">
                <span class="ambient-ring" aria-hidden="true"></span>
                <svg class="play-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m9 6 9 6-9 6Z"></path></svg>
                <svg class="pause-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6v12M15 6v12"></path></svg>
            </button>
            
            <button class="transport" id="nextButton" type="button" aria-label="Next song" title="Next song" onclick="GarbaPlayer.playNext()">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17 5v14M5 6l9 6-9 6Z"></path></svg>
            </button>
            
            <button class="transport heart-button favourite-control" id="favouriteButton" type="button" aria-label="Favourite current song" title="Save to My Garba (F)" onclick="GarbaPlayer.toggleFavorite()">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.9a5.5 5.5 0 0 0-7.8 0L12 5.9l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.3 1-1a5.5 5.5 0 0 0 0-7.8Z"></path></svg>
            </button>
        </section>

        <!-- Progress Slider -->
        <section class="progress-wrap" aria-label="Playback progress">
            <span class="time" id="elapsedTime">0:00</span>
            <input class="progress" id="progress" type="range" min="0" max="1000" value="0" aria-label="Seek track" oninput="GarbaPlayer.onSeek(this.value)">
            <span class="time" id="durationTime">4:27</span>
        </section>

        <!-- Bottom Left: Private Garba Circle & 24/7 Live Badge -->
        <div class="live-station-container" id="liveStationContainer">
            <button class="circle-perch" id="circlePerch" type="button" onclick="openCircleModal()" title="Private Garba Circle: Listen with friends">
                <span class="circle-perch-face" aria-hidden="true">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="4.2" r="1.7"></circle><circle cx="18.75" cy="8.1" r="1.7"></circle><circle cx="18.75" cy="15.9" r="1.7"></circle><circle cx="12" cy="19.8" r="1.7"></circle><circle cx="5.25" cy="15.9" r="1.7"></circle><circle cx="5.25" cy="8.1" r="1.7"></circle><circle cx="12" cy="12" r="1.2"></circle></svg>
                </span>
                <span class="circle-perch-text">
                    <span class="circle-perch-name">Private Garba Circle</span>
                    <span class="circle-perch-kicker">LISTEN WITH FRIENDS</span>
                </span>
            </button>

            <button class="live-station-button" id="liveStationButton" type="button" onclick="GarbaPlayer.toggleLiveRadio()" title="24/7 Live Nonstop Garba Radio">
                <span class="live-beacon" aria-hidden="true">
                    <span class="beacon-ping"></span>
                    <span class="beacon-core"></span>
                </span>
                <span class="live-badge-text">24/7 LIVE</span>
            </button>
        </div>

        <!-- Floating Category Genre Strip Dock -->
        <nav class="genre-strip" id="genreStrip" aria-label="Garba Categories">
            <button class="genre-button" type="button" data-genre="nonstop" onclick="GarbaPlayer.selectGenre('nonstop')">
                <span class="genre-icon-frame"><img src="/assets/genre-icons/nonstop.webp" alt="Nonstop" class="genre-icon-img"></span>
                <span class="genre-label">Nonstop</span>
            </button>
            <button class="genre-button" type="button" data-genre="traditional" onclick="GarbaPlayer.selectGenre('traditional')">
                <span class="genre-icon-frame"><img src="/assets/genre-icons/traditional.webp" alt="Traditional" class="genre-icon-img"></span>
                <span class="genre-label">Traditional</span>
            </button>
            <button class="genre-button" type="button" data-genre="dandiya" onclick="GarbaPlayer.selectGenre('dandiya')">
                <span class="genre-icon-frame"><img src="/assets/genre-icons/dandiya.webp" alt="Dandiya" class="genre-icon-img"></span>
                <span class="genre-label">Dandiya</span>
            </button>
            <button class="genre-button" type="button" data-genre="devotional" onclick="GarbaPlayer.selectGenre('devotional')">
                <span class="genre-icon-frame"><img src="/assets/genre-icons/devotional.webp" alt="Devotional" class="genre-icon-img"></span>
                <span class="genre-label">Devotional</span>
            </button>
            <button class="genre-button active" type="button" data-genre="folk" onclick="GarbaPlayer.selectGenre('folk')">
                <span class="genre-icon-frame"><img src="/assets/genre-icons/folk-dhol.webp" alt="Folk" class="genre-icon-img"></span>
                <span class="genre-label">Folk</span>
            </button>
            <button class="genre-button" type="button" data-genre="sanedo" onclick="GarbaPlayer.selectGenre('sanedo')">
                <span class="genre-icon-frame"><img src="/assets/genre-icons/sanedo.webp" alt="Sanedo" class="genre-icon-img"></span>
                <span class="genre-label">Sanedo</span>
            </button>
            <button class="genre-button" type="button" data-genre="fusion" onclick="GarbaPlayer.selectGenre('fusion')">
                <span class="genre-icon-frame"><img src="/assets/genre-icons/fusion.webp" alt="Fusion" class="genre-icon-img"></span>
                <span class="genre-label">Fusion</span>
            </button>
        </nav>

        <!-- Bottom Right Streaming Badge & Video Stage -->
        <div class="streaming-via-cluster" id="streamingViaCluster">
            <!-- Floating Mini YouTube Video Stage -->
            <div class="yt-stream-frame-container is-minimized" id="ytStreamContainer">
                <div class="yt-stream-head">
                    <span class="yt-live-chip">🔴 YOUTUBE LIVE</span>
                    <button type="button" class="yt-head-btn" onclick="GarbaPlayer.toggleYtVideo()" title="Minimize Video Frame">&minus;</button>
                </div>
                <div class="yt-iframe-wrap">
                    <div id="ytPlayerEmbed"></div>
                </div>
            </div>

            <div class="streaming-via" id="streamingVia" aria-label="Streaming Audio Source" onclick="GarbaPlayer.toggleYtVideo()" title="Click to view / hide YouTube video">
                <span class="streaming-pulse-dot" id="streamingPulseDot"></span>
                <span class="streaming-label">STREAMING VIA</span>
                <span class="yt-brand-lockup">
                    <svg class="youtube-badge-logo" viewBox="0 0 24 24" aria-hidden="true"><path fill="#FF0000" d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814z"/><polygon fill="#FFFFFF" points="9.545,15.568 15.818,12 9.545,8.432"/></svg>
                    <span class="yt-brand-text">YouTube</span>
                </span>
                <span class="yt-expand-arrow">↗</span>
            </div>
        </div>
    </main>

    <!-- ============================================== -->
    <!-- QUICK SEARCH MODAL -->
    <!-- ============================================== -->
    <div class="center-modal" id="searchModal">
        <div class="center-modal-scrim" onclick="closeSearchModal()"></div>
        <div class="center-modal-card">
            <button class="modal-corner-close" onclick="closeSearchModal()">&times;</button>
            <h2>Search Garba Songs</h2>
            <div class="link-input-group" style="margin-top: 16px;">
                <input type="text" id="quickSearchInput" placeholder="Type song name or artist (e.g. Aditya, Atul, Sanedo)..." class="code-input" oninput="GarbaPlayer.onQuickSearch(this.value)">
            </div>
            <div id="quickSearchResults" style="margin-top: 14px; max-height: 280px; overflow-y: auto;"></div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- UP NEXT / QUEUE MODAL -->
    <!-- ============================================== -->
    <div class="side-modal" id="queueModal">
        <div class="side-modal-scrim" onclick="closeQueueModal()"></div>
        <div class="side-modal-panel">
            <div class="side-modal-head">
                <h3>Up Next In Queue</h3>
                <button class="side-close-btn" onclick="closeQueueModal()">&times;</button>
            </div>
            <div class="side-modal-body" id="queueList"></div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- LIKED SONGS / FAVOURITES MODAL -->
    <!-- ============================================== -->
    <div class="side-modal" id="favouritesModal">
        <div class="side-modal-scrim" onclick="closeFavouritesModal()"></div>
        <div class="side-modal-panel">
            <div class="side-modal-head">
                <h3>My Garba (Liked Songs ❤️)</h3>
                <button class="side-close-btn" onclick="closeFavouritesModal()">&times;</button>
            </div>
            <div class="side-modal-body" id="favouritesList">
                <div class="empty-hint">Click the heart icon on any song to save it to your favourites.</div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- PRIVATE GARBA CIRCLE MODAL -->
    <!-- ============================================== -->
    <div class="center-modal" id="circleModal">
        <div class="center-modal-scrim" onclick="closeCircleModal()"></div>
        <div class="center-modal-card">
            <button class="modal-corner-close" onclick="closeCircleModal()">&times;</button>
            <div class="circle-card-icon">
                <svg viewBox="0 0 24 24" width="48" height="48" stroke="#d6b06f" fill="none" stroke-width="1.8">
                    <circle cx="12" cy="4.2" r="1.7"></circle><circle cx="18.75" cy="8.1" r="1.7"></circle><circle cx="18.75" cy="15.9" r="1.7"></circle><circle cx="12" cy="19.8" r="1.7"></circle><circle cx="5.25" cy="15.9" r="1.7"></circle><circle cx="5.25" cy="8.1" r="1.7"></circle><circle cx="12" cy="12" r="1.2"></circle>
                </svg>
            </div>
            <h2>Private Garba Circle</h2>
            <p>Listen together in real time. Everyone dances to the exact same beat!</p>
            
            <div class="circle-modal-actions">
                <a href="/circle/room/BARODA26" class="btn btn-gold btn-full">Enter Live Room: BARODA26 🎧</a>
                <div class="or-divider"><span>OR JOIN WITH CODE</span></div>
                <form action="/circle/join" method="GET" class="join-code-row">
                    <input type="text" name="code" placeholder="Enter Room Code" class="code-input" required>
                    <button type="submit" class="btn btn-ivory">Join</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- YOUTUBE LINK STREAM MODAL -->
    <!-- ============================================== -->
    <div class="center-modal" id="linkSongModal">
        <div class="center-modal-scrim" onclick="closeLinkSongModal()"></div>
        <div class="center-modal-card">
            <button class="modal-corner-close" onclick="closeLinkSongModal()">&times;</button>
            <h2>Play Any Song / Stream</h2>
            <p>Paste any YouTube link, MP3 URL, or sound clip to stream it inside the courtyard.</p>
            <div class="link-input-group">
                <input type="text" id="customAudioUrl" value="https://youtu.be/MASCw3qDBsQ" placeholder="https://youtube.com/watch?v=... or .mp3 link" class="code-input">
                <button type="button" class="btn btn-gold" onclick="GarbaPlayer.playCustomUrl()">Load & Play</button>
            </div>
            <div class="quick-yt-presets" style="margin-top: 16px; text-align: left;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 8px;">
                    <p style="font-size: 0.8rem; color: #d6b06f; margin: 0; font-weight: 600;" id="presetYtHeader">FEATURED YOUTUBE STREAMS (20):</p>
                    <span style="font-size:0.7rem; color:var(--muted);">Click any track to stream</span>
                </div>
                <div class="preset-chips-scroll" id="presetYtList" style="max-height: 280px; overflow-y: auto; display: flex; flex-direction: column; gap: 6px; padding-right: 4px;">
                    <button type="button" class="quick-preset-chip" onclick="GarbaPlayer.playSongByYouTubeId('MASCw3qDBsQ', 'Best of Aditya Gadhvi Non stop', 'Aditya Gadhvi'); closeLinkSongModal();">
                        <span>▶ Best of Aditya Gadhvi Non stop (https://youtu.be/MASCw3qDBsQ)</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- MORE CARD DIALOG -->
    <!-- ============================================== -->
    <div class="side-modal" id="moreModal">
        <div class="side-modal-scrim" onclick="closeMoreModal()"></div>
        <div class="side-modal-panel">
            <div class="side-modal-head">
                <h3>Garba26 Options</h3>
                <button class="side-close-btn" onclick="closeMoreModal()">&times;</button>
            </div>
            <div class="more-menu-options">
                <button class="more-option-item" onclick="GarbaPlayer.toggleTheme()">
                    <span class="opt-icon">🏛️</span>
                    <div>
                        <strong>Switch Courtyard Theme</strong>
                        <small>Cycle between Folk, Devotional, Dandiya & Master Dark</small>
                    </div>
                </button>
                <button class="more-option-item" onclick="openCircleModal(); closeMoreModal();">
                    <span class="opt-icon">⭕</span>
                    <div>
                        <strong>Garba Circle (Live Sync)</strong>
                        <small>Listen together with friends in synchrony</small>
                    </div>
                </button>
                <button class="more-option-item" onclick="GarbaPlayer.toggleSynth()">
                    <span class="opt-icon">🥁</span>
                    <div>
                        <strong>Live Dhol Rhythm Synthesizer</strong>
                        <small>Toggle browser Web Audio percussion engine</small>
                    </div>
                </button>
                <a href="/admin" class="more-option-item">
                    <span class="opt-icon">👑</span>
                    <div>
                        <strong>Admin Portal</strong>
                        <small>Manage songs, albums, and maestros</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
