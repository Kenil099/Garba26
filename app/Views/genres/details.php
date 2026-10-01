<!-- app/Views/genres/details.php -->
<div class="genre-details-page">
    <div class="page-title-bar">
        <h1><?= htmlspecialchars($genre['name']) ?></h1>
        <p><?= htmlspecialchars($genre['description'] ?? '') ?></p>
    </div>
    <div class="tracklist-table">
        <div class="table-body">
            <?php foreach ($songs as $i => $s): ?>
                <div class="track-row" onclick="GarbaPlayer.playTrack(<?= $s['id'] ?>)">
                    <span class="td-num"><?= $i + 1 ?></span>
                    <span class="td-title"><?= htmlspecialchars($s['title']) ?></span>
                    <span class="td-plays"><?= number_format($s['plays_count']) ?> plays</span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
