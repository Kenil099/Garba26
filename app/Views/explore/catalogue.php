<!-- app/Views/explore/catalogue.php -->
<div class="catalogue-page">
    <div class="page-title-bar">
        <h1>Complete Garba Catalogue</h1>
        <p>Every single track available on Garba26.</p>
    </div>

    <div class="tracklist-table">
        <div class="table-header">
            <span class="th-num">#</span>
            <span class="th-title">TITLE</span>
            <span class="th-artist">ARTIST</span>
            <span class="th-style">STYLE</span>
            <span class="th-plays">PLAYS</span>
            <span class="th-action"></span>
        </div>
        <div class="table-body">
            <?php foreach ($songs as $i => $s): ?>
                <div class="track-row" onclick="GarbaPlayer.playTrack(<?= $s['id'] ?>)">
                    <span class="td-num"><?= $i + 1 ?></span>
                    <span class="td-title">
                        <img src="<?= htmlspecialchars($s['cover_image'] ?? '/assets/images/default-album.png') ?>" class="row-thumb" alt="Cover">
                        <span class="row-name"><?= htmlspecialchars($s['title']) ?></span>
                    </span>
                    <span class="td-artist"><?= htmlspecialchars($s['artist_id']) ?></span>
                    <span class="td-style"><span class="badge-tag"><?= htmlspecialchars($s['style']) ?></span></span>
                    <span class="td-plays"><?= number_format($s['plays_count']) ?></span>
                    <span class="td-action" onclick="event.stopPropagation()">
                        <button class="icon-action-btn" onclick="GarbaFavorites.toggle(<?= $s['id'] ?>, this)">❤️</button>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
