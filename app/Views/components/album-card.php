<!-- app/Views/components/album-card.php -->
<a href="/album/<?= htmlspecialchars($album['slug']) ?>" class="song-card-item">
    <div class="card-cover-wrapper">
        <img src="<?= htmlspecialchars($album['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="Cover" class="card-img">
    </div>
    <div class="card-body">
        <h4 class="card-title"><?= htmlspecialchars($album['title']) ?></h4>
        <span class="card-subtitle"><?= htmlspecialchars($album['release_year'] ?? '') ?></span>
    </div>
</a>
