<?php
// app/Views/layouts/music-player.php
?>
<div class="garba-music-player" id="global-music-player">
    <div class="player-container">
        <!-- Left: Track Metadata -->
        <div class="player-track-info">
            <div class="track-thumb-wrapper">
                <img src="/assets/images/default-album.png" id="player-thumb" alt="Track Cover" class="track-thumb">
                <div class="sound-wave-bars" id="sound-wave">
                    <span></span><span></span><span></span><span></span>
                </div>
            </div>
            <div class="track-details">
                <div class="track-title" id="player-title">Select a Garba track</div>
                <div class="track-artist" id="player-artist">Garba26 Audio Engine</div>
            </div>
            <button class="track-like-btn" id="player-like-btn" title="Save to Favorites">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            </button>
        </div>

        <!-- Center: Playback Controls & Progress Bar -->
        <div class="player-center-controls">
            <div class="player-buttons">
                <button class="ctrl-btn" id="player-shuffle" title="Shuffle">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 3 21 3 21 8"></polyline><line x1="4" y1="20" x2="21" y2="3"></line><polyline points="21 16 21 21 16 21"></polyline><line x1="15" y1="15" x2="21" y2="21"></line><line x1="4" y1="4" x2="9" y2="9"></line></svg>
                </button>
                <button class="ctrl-btn" id="player-prev" title="Previous Track">
                    <img src="/assets/icons/previous.svg" alt="Previous">
                </button>
                <button class="ctrl-btn play-pause-btn" id="player-play-pause" title="Play">
                    <img src="/assets/icons/play.svg" id="play-pause-icon" alt="Play">
                </button>
                <button class="ctrl-btn" id="player-next" title="Next Track">
                    <img src="/assets/icons/next.svg" alt="Next">
                </button>
                <button class="ctrl-btn" id="player-repeat" title="Repeat Track">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg>
                </button>
            </div>

            <div class="progress-bar-wrapper">
                <span class="time-stamp" id="current-time">0:00</span>
                <div class="progress-bar-rail" id="progress-rail">
                    <div class="progress-bar-fill" id="progress-fill"></div>
                    <div class="progress-bar-scrubber" id="progress-scrubber"></div>
                </div>
                <span class="time-stamp" id="total-time">3:30</span>
            </div>
        </div>

        <!-- Right: Utility Controls (Queue, Volume, Beat Mode, Lyrics) -->
        <div class="player-right-controls">
            <!-- Web Audio Synthesizer Beat Indicator -->
            <button class="util-btn beat-synth-toggle active" id="beat-synth-btn" title="Garba Live Dhol Beat Synthesizer Active">
                <span class="dhol-icon">🥁</span>
                <span class="synth-label">Dhol FX</span>
            </button>
            
            <button class="util-btn" id="queue-toggle-btn" title="Playing Queue">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
            </button>

            <button class="util-btn" id="lyrics-btn" title="Lyrics & Tahuko">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            </button>

            <!-- Volume Control -->
            <div class="volume-control-wrap">
                <button class="util-btn" id="volume-icon-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>
                </button>
                <input type="range" min="0" max="1" step="0.01" value="0.8" class="volume-slider" id="volume-slider" aria-label="Audio Volume">
            </div>
        </div>
    </div>
</div>

<!-- Slide-out Playing Queue Drawer -->
<div class="queue-drawer" id="queue-drawer">
    <div class="queue-header">
        <h3>Up Next</h3>
        <button class="close-drawer-btn" id="close-queue">&times;</button>
    </div>
    <div class="queue-list" id="queue-items-container">
        <!-- Rendered by player.js -->
    </div>
</div>

<!-- Lyrics & Tahuko Modal -->
<div class="lyrics-modal" id="lyrics-modal">
    <div class="lyrics-modal-content">
        <button class="close-lyrics-btn" id="close-lyrics">&times;</button>
        <h2 id="lyrics-song-title">Song Lyrics & Tahuko</h2>
        <h4 id="lyrics-artist-name">Artist</h4>
        <div class="lyrics-text" id="lyrics-body">
            No lyrics available for this track.
        </div>
    </div>
</div>
