<!-- app/Views/explore/traditions.php -->
<div class="explore-page">
    <div class="page-title-bar">
        <h1>Tradition: <?= htmlspecialchars($selectedTradition) ?></h1>
        <p>Regional heritage from Gujarat's historic Navratri centers.</p>
    </div>

    <div class="style-filter-buttons">
        <?php foreach ($traditions as $key => $label): ?>
            <a href="/explore/traditions?tradition=<?= urlencode($key) ?>" class="btn <?= $key === $selectedTradition ? 'btn-primary' : 'btn-outline' ?>">
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
                </div>
                <div class="card-body">
                    <a href="/song/<?= $song['id'] ?>" class="card-title"><?= htmlspecialchars($song['title']) ?></a>
                    <span class="card-subtitle"><?= htmlspecialchars($song['artist_name']) ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
