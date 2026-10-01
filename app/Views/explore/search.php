<!-- app/Views/explore/search.php -->
<div class="search-page-container">
    <div class="search-hero">
        <h2>Search Results for "<?= htmlspecialchars($query) ?>"</h2>
        <p>Found matches across Songs, Artists, and Albums.</p>
    </div>

    <?php if (empty($results['songs']) && empty($results['artists']) && empty($results['albums'])): ?>
        <div class="empty-state">
            <div class="empty-icon">🔍</div>
            <h3>No results found</h3>
            <p>Try searching for "3-Taali", "Atul Purohit", "Khalasi", or "Sanedo".</p>
        </div>
    <?php else: ?>
        <?php if (!empty($results['songs'])): ?>
            <div class="section-block">
                <h3 class="section-title">Matching Songs</h3>
                <div class="tracklist-table">
                    <div class="table-body">
                        <?php foreach ($results['songs'] as $song): ?>
                            <div class="track-row" onclick="GarbaPlayer.playTrack(<?= $song['id'] ?>)">
                                <span class="td-title">
                                    <img src="<?= htmlspecialchars($song['cover_image'] ?? '/assets/images/default-album.png') ?>" class="row-thumb" alt="Cover">
                                    <span class="row-name"><?= htmlspecialchars($song['title']) ?></span>
                                </span>
                                <span class="td-artist"><?= htmlspecialchars($song['artist_name']) ?></span>
                                <span class="td-style"><span class="badge-tag"><?= htmlspecialchars($song['style']) ?></span></span>
                                <span class="td-plays"><?= number_format($song['plays_count']) ?> plays</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($results['artists'])): ?>
            <div class="section-block mt-4">
                <h3 class="section-title">Matching Artists</h3>
                <div class="artists-grid">
                    <?php foreach ($results['artists'] as $art): ?>
                        <a href="/artist/<?= htmlspecialchars($art['slug']) ?>" class="artist-card-item">
                            <div class="artist-avatar-wrap">
                                <img src="<?= htmlspecialchars($art['image'] ?? '/assets/images/default-avatar.png') ?>" alt="<?= htmlspecialchars($art['name']) ?>" class="artist-img">
                            </div>
                            <h4 class="artist-name"><?= htmlspecialchars($art['name']) ?></h4>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
