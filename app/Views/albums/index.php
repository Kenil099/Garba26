<!-- app/Views/albums/index.php -->
<div class="albums-index-page">
    <div class="page-title-bar">
        <h1>Garba Albums & Navratri Sets</h1>
        <p>Curated festival compilations and studio albums.</p>
    </div>
    <div class="cards-grid">
        <?php foreach ($albums as $alb): ?>
            <a href="/album/<?= htmlspecialchars($alb['slug']) ?>" class="song-card-item">
                <div class="card-cover-wrapper">
                    <img src="<?= htmlspecialchars($alb['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="Cover" class="card-img">
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?= htmlspecialchars($alb['title']) ?></h4>
                    <span class="card-subtitle"><?= htmlspecialchars($alb['release_year'] ?? '2026') ?></span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
