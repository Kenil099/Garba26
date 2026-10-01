<!-- app/Views/songs/index.php -->
<div class="songs-index-page">
    <div class="page-title-bar">
        <h1>All Garba Anthems</h1>
        <p>Explore the full vault of high-fidelity tracks.</p>
    </div>

    <div class="tracklist-table">
        <div class="table-body">
            <?php foreach ($songs as $i => $s): ?>
                <div class="track-row" onclick="GarbaPlayer.playTrack(<?= $s['id'] ?>)">
                    <span class="td-num"><?= $i + 1 ?></span>
                    <span class="td-title">
                        <img src="<?= htmlspecialchars($s['cover_image'] ?? '/assets/images/default-album.png') ?>" class="row-thumb" alt="Cover">
                        <span class="row-name"><?= htmlspecialchars($s['title']) ?></span>
                    </span>
                    <span class="td-style"><span class="badge-tag"><?= htmlspecialchars($s['style']) ?></span></span>
                    <span class="td-plays"><?= number_format($s['plays_count']) ?> plays</span>
                    <span class="td-action" onclick="event.stopPropagation()">
                        <button class="icon-action-btn" onclick="GarbaFavorites.toggle(<?= $s['id'] ?>, this)">❤️</button>
                        <button class="icon-action-btn" onclick="GarbaShare.open(<?= $s['id'] ?>)">🔗</button>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
