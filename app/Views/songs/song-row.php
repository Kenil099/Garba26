<!-- app/Views/songs/song-row.php -->
<div class="track-row" onclick="GarbaPlayer.playTrack(<?= $song['id'] ?>)">
    <span class="td-num">▶</span>
    <span class="td-title">
        <img src="<?= htmlspecialchars($song['cover_image'] ?? '/assets/images/default-album.png') ?>" class="row-thumb" alt="Cover">
        <span class="row-name"><?= htmlspecialchars($song['title']) ?></span>
    </span>
    <span class="td-artist"><?= htmlspecialchars($song['artist_name'] ?? '') ?></span>
    <span class="td-style"><?= htmlspecialchars($song['style'] ?? '') ?></span>
</div>
