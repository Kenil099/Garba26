<!-- app/Views/components/song-card.php -->
<div class="song-card-item">
    <div class="card-cover-wrapper">
        <img src="<?= htmlspecialchars($song['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="Cover" class="card-img">
        <button class="card-play-btn" onclick="GarbaPlayer.playTrack(<?= $song['id'] ?>)">
            <img src="/assets/icons/play.svg" alt="Play">
        </button>
    </div>
    <div class="card-body">
        <a href="/song/<?= $song['id'] ?>" class="card-title"><?= htmlspecialchars($song['title']) ?></a>
        <span class="card-subtitle"><?= htmlspecialchars($song['artist_name'] ?? '') ?></span>
    </div>
</div>
