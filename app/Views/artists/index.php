<!-- app/Views/artists/index.php -->
<div class="artists-index-page">
    <div class="page-title-bar">
        <h1>All Garba Artists & Folk Icons</h1>
        <p>The voices that bring the festival alive.</p>
    </div>
    <div class="artists-grid">
        <?php foreach ($artists as $art): ?>
            <a href="/artist/<?= htmlspecialchars($art['slug']) ?>" class="artist-card-item">
                <div class="artist-avatar-wrap">
                    <img src="<?= htmlspecialchars($art['image'] ?? '/assets/images/default-avatar.png') ?>" alt="<?= htmlspecialchars($art['name']) ?>" class="artist-img">
                </div>
                <h4 class="artist-name"><?= htmlspecialchars($art['name']) ?></h4>
                <p class="artist-type"><?= htmlspecialchars($art['genres'] ?? '') ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>
