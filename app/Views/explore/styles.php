<!-- app/Views/explore/styles.php -->
<div class="explore-page">
    <div class="page-title-bar">
        <h1>Garba Styles: <?= htmlspecialchars($selectedStyle) ?></h1>
        <p>Explore classic footwork patterns and rhythms.</p>
    </div>

    <div class="style-filter-buttons">
        <?php foreach ($styles as $key => $label): ?>
            <a href="/explore/styles?style=<?= urlencode($key) ?>" class="btn <?= $key === $selectedStyle ? 'btn-primary' : 'btn-outline' ?>">
                <?= htmlspecialchars($label) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="cards-grid mt-4">
        <?php foreach ($songs as $song): ?>
            <div class="song-card-item">
                <div class="card-cover-wrapper">
                    <img src="<?= htmlspecialchars($song['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="Cover" class="card-img">
                    <button class="card-play-btn" onclick="GarbaPlayer.playTrack(<?= $song['id'] ?>)">
                        <img src="/assets/icons/play.svg" alt="Play">
                    </button>
                    <span class="style-pill"><?= htmlspecialchars($song['style']) ?></span>
                </div>
                <div class="card-body">
                    <a href="/song/<?= $song['id'] ?>" class="card-title"><?= htmlspecialchars($song['title']) ?></a>
                    <span class="card-subtitle"><?= htmlspecialchars($song['artist_name']) ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
