<!-- app/Views/playlists/playlist-card.php -->
<a href="/playlist/<?= $playlist['id'] ?>" class="song-card-item">
    <div class="card-cover-wrapper">
        <img src="<?= htmlspecialchars($playlist['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="Cover" class="card-img">
    </div>
    <div class="card-body">
        <h4 class="card-title"><?= htmlspecialchars($playlist['title']) ?></h4>
    </div>
</a>
