<!-- app/Views/my-garba/recently-played.php -->
<div class="history-page">
    <div class="page-title-bar">
        <h1>Recently Played</h1>
        <p>Songs you listened to recently.</p>
    </div>

    <div class="tracklist-table">
        <div class="table-body">
            <?php foreach ($history as $i => $s): ?>
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
        </div>
    </div>
</div>
