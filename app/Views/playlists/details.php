<!-- app/Views/playlists/details.php -->
<div class="playlist-details-page">
    <div class="song-hero-banner">
        <img src="<?= htmlspecialchars($playlist['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="Cover" class="song-hero-art">
        <div class="song-hero-info">
            <span class="badge-tag">PLAYLIST</span>
            <h1 class="song-hero-title"><?= htmlspecialchars($playlist['title']) ?></h1>
            <p class="song-hero-artist"><?= htmlspecialchars($playlist['description'] ?? '') ?></p>
        </div>
    </div>

    <div class="section-block mt-4">
        <div class="tracklist-table">
            <div class="table-body">
                <?php if (empty($songs)): ?>
                    <div class="empty-state">
                        <p>This playlist is empty. Browse songs and click ➕ to add tracks!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($songs as $i => $s): ?>
                        <div class="track-row" onclick="GarbaPlayer.playTrack(<?= $s['id'] ?>)">
                            <span class="td-num"><?= $i + 1 ?></span>
                            <span class="td-title">
                                <img src="<?= htmlspecialchars($s['cover_image'] ?? '/assets/images/default-album.png') ?>" class="row-thumb" alt="Cover">
                                <span class="row-name"><?= htmlspecialchars($s['title']) ?></span>
                            </span>
                            <span class="td-artist"><?= htmlspecialchars($s['artist_name']) ?></span>
                            <span class="td-style"><?= htmlspecialchars($s['style']) ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
