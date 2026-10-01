<!-- app/Views/albums/details.php -->
<div class="album-details-page">
    <div class="song-hero-banner">
        <img src="<?= htmlspecialchars($album['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="Cover" class="song-hero-art">
        <div class="song-hero-info">
            <span class="badge-tag">ALBUM • <?= htmlspecialchars($album['release_year'] ?? '2026') ?></span>
            <h1 class="song-hero-title"><?= htmlspecialchars($album['title']) ?></h1>
            <p class="song-hero-artist">Artist: <?= htmlspecialchars($album['artist_name'] ?? 'Various Artists') ?></p>
            <p class="album-desc"><?= htmlspecialchars($album['description'] ?? '') ?></p>
        </div>
    </div>

    <div class="section-block mt-4">
        <h3 class="section-title">Tracklist</h3>
        <div class="tracklist-table">
            <div class="table-body">
                <?php foreach ($songs as $i => $s): ?>
                    <div class="track-row" onclick="GarbaPlayer.playTrack(<?= $s['id'] ?>)">
                        <span class="td-num"><?= $i + 1 ?></span>
                        <span class="td-title">
                            <span class="row-name"><?= htmlspecialchars($s['title']) ?></span>
                        </span>
                        <span class="td-style"><?= htmlspecialchars($s['style']) ?></span>
                        <span class="td-plays"><?= number_format($s['plays_count']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
