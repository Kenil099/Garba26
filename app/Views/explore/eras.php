<!-- app/Views/explore/eras.php -->
<div class="explore-page">
    <div class="page-title-bar">
        <h1>Musical Eras: <?= htmlspecialchars($selectedEra) ?></h1>
        <p>From centuries-old Gujarati folklore to 90s Khelaiya cassetes and 2026 fusion.</p>
    </div>

    <div class="style-filter-buttons">
        <?php foreach ($eras as $key => $label): ?>
            <a href="/explore/eras?era=<?= urlencode($key) ?>" class="btn <?= $key === $selectedEra ? 'btn-primary' : 'btn-outline' ?>">
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
