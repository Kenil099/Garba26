<!-- app/Views/genres/index.php -->
<div class="genres-page">
    <div class="page-title-bar">
        <h1>All Garba Categories</h1>
    </div>
    <div class="genres-cards-grid">
        <?php foreach ($genres as $g): ?>
            <a href="/genre/<?= htmlspecialchars($g['slug']) ?>" class="genre-tile">
                <div class="tile-title"><?= htmlspecialchars($g['name']) ?></div>
                <p class="tile-desc"><?= htmlspecialchars($g['description'] ?? '') ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>
