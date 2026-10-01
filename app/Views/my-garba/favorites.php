<!-- app/Views/my-garba/favorites.php -->
<div class="favorites-page">
    <div class="page-title-bar">
        <h1>Liked Songs ❤️</h1>
        <p>Your personally bookmarked Garba tracks.</p>
    </div>

    <div class="tracklist-table">
        <div class="table-body">
            <?php if (empty($favorites)): ?>
                <div class="empty-state">
                    <div class="empty-icon">🤍</div>
                    <h3>No liked songs yet</h3>
                    <p>Click the heart icon on any song to save it to your library.</p>
                </div>
            <?php else: ?>
                <?php foreach ($favorites as $i => $s): ?>
                    <div class="track-row" onclick="GarbaPlayer.playTrack(<?= $s['id'] ?>)">
                        <span class="td-num"><?= $i + 1 ?></span>
                        <span class="td-title">
                            <img src="<?= htmlspecialchars($s['cover_image'] ?? '/assets/images/default-album.png') ?>" class="row-thumb" alt="Cover">
                            <span class="row-name"><?= htmlspecialchars($s['title']) ?></span>
                        </span>
                        <span class="td-artist"><?= htmlspecialchars($s['artist_name']) ?></span>
                        <span class="td-style"><span class="badge-tag"><?= htmlspecialchars($s['style']) ?></span></span>
                        <span class="td-action" onclick="event.stopPropagation()">
                            <button class="icon-action-btn" onclick="GarbaFavorites.toggle(<?= $s['id'] ?>, this)">❤️</button>
                        </span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
