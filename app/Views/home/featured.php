<!-- app/Views/home/featured.php -->
<section class="section-block featured-section">
    <div class="section-header">
        <h2 class="section-title">Featured Garba Anthems</h2>
        <span class="section-subtitle">Specially curated high-vibe festival releases</span>
    </div>
    <div class="cards-grid">
        <?php foreach ($featured as $song): ?>
            <div class="song-card-item">
                <div class="card-cover-wrapper">
                    <img src="<?= htmlspecialchars($song['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="<?= htmlspecialchars($song['title']) ?>" class="card-img" loading="lazy">
                    <button class="card-play-btn" onclick="GarbaPlayer.playTrack(<?= $song['id'] ?>)" title="Play <?= htmlspecialchars($song['title']) ?>">
                        <img src="/assets/icons/play.svg" alt="Play">
                    </button>
                    <span class="style-pill"><?= htmlspecialchars($song['style']) ?></span>
                </div>
                <div class="card-body">
                    <a href="/song/<?= $song['id'] ?>" class="card-title" title="<?= htmlspecialchars($song['title']) ?>">
                        <?= htmlspecialchars($song['title']) ?>
                    </a>
                    <a href="/artist/<?= urlencode(strtolower(str_replace(' ', '-', $song['artist_name']))) ?>" class="card-subtitle">
                        <?= htmlspecialchars($song['artist_name']) ?>
                    </a>
                    <div class="card-meta">
                        <span class="plays-badge">🔥 <?= number_format($song['plays_count']) ?> plays</span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
