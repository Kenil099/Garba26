<!-- app/Views/songs/details.php -->
<div class="song-details-page">
    <div class="song-hero-banner">
        <img src="<?= htmlspecialchars($song['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="<?= htmlspecialchars($song['title']) ?>" class="song-hero-art">
        <div class="song-hero-info">
            <span class="badge-tag"><?= htmlspecialchars($song['style']) ?> • <?= htmlspecialchars($song['tradition']) ?></span>
            <h1 class="song-hero-title"><?= htmlspecialchars($song['title']) ?></h1>
            <p class="song-hero-artist">
                By <a href="/artist/<?= urlencode(strtolower(str_replace(' ', '-', $song['artist_name']))) ?>"><?= htmlspecialchars($song['artist_name']) ?></a>
                <?php if (!empty($song['album_title'])): ?>
                    • Album: <a href="/album/<?= urlencode(strtolower(str_replace(' ', '-', $song['album_title']))) ?>"><?= htmlspecialchars($song['album_title']) ?></a>
                <?php endif; ?>
            </p>
            <div class="song-hero-actions">
                <button class="btn btn-primary btn-lg" onclick="GarbaPlayer.playTrack(<?= $song['id'] ?>)">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                    <span>Play Now</span>
                </button>
                <button class="btn btn-outline" onclick="GarbaFavorites.toggle(<?= $song['id'] ?>, this)">
                    <?= $isFavorited ? '❤️ Liked' : '🤍 Like' ?>
                </button>
                <button class="btn btn-outline" onclick="GarbaPlaylistModal.open(<?= $song['id'] ?>)">
                    ➕ Add to Playlist
                </button>
                <button class="btn btn-outline" onclick="GarbaShare.open(<?= $song['id'] ?>)">
                    🔗 Share
                </button>
            </div>
        </div>
    </div>

    <!-- Lyrics & Tahuko Section -->
    <?php if (!empty($song['lyrics'])): ?>
        <div class="lyrics-card mt-4">
            <h3 class="lyrics-card-title">Lyrics & Tahuko (સાહિત્ય / તાહુકો)</h3>
            <div class="lyrics-content-gujarati">
                <?= nl2br(htmlspecialchars($song['lyrics'])) ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Related Tracks -->
    <div class="section-block mt-4">
        <h3 class="section-title">Similar <?= htmlspecialchars($song['style']) ?> Tracks</h3>
        <div class="cards-grid">
            <?php foreach ($related as $rel): ?>
                <div class="song-card-item">
                    <div class="card-cover-wrapper">
                        <img src="<?= htmlspecialchars($rel['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="Cover" class="card-img">
                        <button class="card-play-btn" onclick="GarbaPlayer.playTrack(<?= $rel['id'] ?>)">
                            <img src="/assets/icons/play.svg" alt="Play">
                        </button>
                    </div>
                    <div class="card-body">
                        <a href="/song/<?= $rel['id'] ?>" class="card-title"><?= htmlspecialchars($rel['title']) ?></a>
                        <span class="card-subtitle"><?= htmlspecialchars($rel['artist_name']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
