<!-- app/Views/explore/index.php -->
<div class="explore-page">
    <div class="page-title-bar">
        <h1>Explore Garba World</h1>
        <p>Dive into styles, eras, traditions, and festival specials.</p>
    </div>

    <!-- Category Filters Navigation -->
    <div class="explore-tabs">
        <a href="/explore" class="tab-link active">All Categories</a>
        <a href="/explore/styles?style=2-Taali" class="tab-link">2-Taali</a>
        <a href="/explore/styles?style=3-Taali" class="tab-link">3-Taali</a>
        <a href="/explore/styles?style=Raas" class="tab-link">Dandiya Raas</a>
        <a href="/explore/styles?style=Sanedo" class="tab-link">Sanedo</a>
        <a href="/explore/styles?style=Dakla" class="tab-link">Dakla</a>
        <a href="/explore/traditions?tradition=United+Way" class="tab-link">United Way</a>
        <a href="/explore/catalogue" class="tab-link">All Tracks</a>
    </div>

    <!-- Genres Grid -->
    <div class="genres-cards-grid">
        <?php foreach ($genres as $genre): ?>
            <a href="/genre/<?= htmlspecialchars($genre['slug']) ?>" class="genre-tile">
                <div class="tile-title"><?= htmlspecialchars($genre['name']) ?></div>
                <p class="tile-desc"><?= htmlspecialchars($genre['description'] ?? '') ?></p>
                <div class="tile-shine"></div>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Trending section -->
    <div class="section-block mt-4">
        <div class="section-header">
            <h2 class="section-title">Trending This Navratri Season</h2>
        </div>
        <div class="cards-grid">
            <?php foreach (array_slice($trending, 0, 6) as $song): ?>
                <div class="song-card-item">
                    <div class="card-cover-wrapper">
                        <img src="<?= htmlspecialchars($song['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="<?= htmlspecialchars($song['title']) ?>" class="card-img">
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
</div>
