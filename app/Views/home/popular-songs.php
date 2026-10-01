<!-- app/Views/home/popular-songs.php -->
<section class="section-block popular-section">
    <div class="section-header">
        <h2 class="section-title">Top Charts & Viral Beats</h2>
        <a href="/songs" class="section-link">View all 50+ songs &rarr;</a>
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
            <?php foreach (array_slice($popular, 0, 8) as $index => $song): ?>
                <div class="track-row" onclick="GarbaPlayer.playTrack(<?= $song['id'] ?>)">
                    <span class="td-num">
                        <span class="num-display"><?= $index + 1 ?></span>
                        <button class="row-play-btn" title="Play">▶</button>
                    </span>
                    <span class="td-title">
                        <img src="<?= htmlspecialchars($song['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="Cover" class="row-thumb">
                        <span class="row-name"><?= htmlspecialchars($song['title']) ?></span>
                    </span>
                    <span class="td-artist"><?= htmlspecialchars($song['artist_name']) ?></span>
                    <span class="td-style"><span class="badge-tag"><?= htmlspecialchars($song['style']) ?></span></span>
                    <span class="td-plays"><?= number_format($song['plays_count']) ?></span>
                    <span class="td-action" onclick="event.stopPropagation()">
                        <button class="icon-action-btn" onclick="GarbaFavorites.toggle(<?= $song['id'] ?>, this)" title="Add to Favorites">
                            ❤️
                        </button>
                        <button class="icon-action-btn" onclick="GarbaPlaylistModal.open(<?= $song['id'] ?>)" title="Add to Playlist">
                            ➕
                        </button>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
