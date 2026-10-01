<!-- app/Views/home/popular-artists.php -->
<section class="section-block artists-section">
    <div class="section-header">
        <h2 class="section-title">Legendary Garba Maestros</h2>
        <a href="/artists" class="section-link">See all artists &rarr;</a>
    </div>
    <div class="artists-grid">
        <?php foreach ($artists as $art): ?>
            <a href="/artist/<?= htmlspecialchars($art['slug']) ?>" class="artist-card-item">
                <div class="artist-avatar-wrap">
                    <img src="<?= htmlspecialchars($art['image'] ?? '/assets/images/default-avatar.png') ?>" alt="<?= htmlspecialchars($art['name']) ?>" class="artist-img" loading="lazy">
                    <div class="artist-verified-badge" title="Verified Maestro">✓</div>
                </div>
                <h4 class="artist-name"><?= htmlspecialchars($art['name']) ?></h4>
                <p class="artist-type"><?= htmlspecialchars($art['genres'] ?? 'Garba / Folk') ?></p>
                <span class="artist-listeners"><?= number_format($art['monthly_listeners']) ?> listeners</span>
            </a>
        <?php endforeach; ?>
    </div>
</section>
