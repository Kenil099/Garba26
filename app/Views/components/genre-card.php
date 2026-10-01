<!-- app/Views/components/genre-card.php -->
<a href="/genre/<?= htmlspecialchars($genre['slug']) ?>" class="genre-tile">
    <div class="tile-title"><?= htmlspecialchars($genre['name']) ?></div>
    <p class="tile-desc"><?= htmlspecialchars($genre['description'] ?? '') ?></p>
</a>
