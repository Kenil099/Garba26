<!-- app/Views/artists/details.php -->
<div class="artist-profile-page">
    <div class="artist-banner">
        <div class="artist-header-content">
            <img src="<?= htmlspecialchars($artist['image'] ?? '/assets/images/default-avatar.png') ?>" alt="<?= htmlspecialchars($artist['name']) ?>" class="artist-header-avatar">
            <div class="artist-header-meta">
                <span class="verified-pill">✓ Verified Maestro</span>
                <h1 class="artist-header-name"><?= htmlspecialchars($artist['name']) ?></h1>
                <p class="artist-header-bio"><?= htmlspecialchars($artist['bio'] ?? '') ?></p>
                <div class="artist-header-stats">
                    <strong><?= number_format($artist['monthly_listeners']) ?></strong> monthly listeners
                </div>
            </div>
        </div>
    </div>

    <!-- Popular songs by this artist -->
    <div class="section-block mt-4">
        <h3 class="section-title">Popular Tracks by <?= htmlspecialchars($artist['name']) ?></h3>
        <div class="tracklist-table">
            <div class="table-body">
                <?php foreach ($songs as $i => $s): ?>
                    <div class="track-row" onclick="GarbaPlayer.playTrack(<?= $s['id'] ?>)">
                        <span class="td-num"><?= $i + 1 ?></span>
                        <span class="td-title">
                            <img src="<?= htmlspecialchars($s['cover_image'] ?? '/assets/images/default-album.png') ?>" class="row-thumb" alt="Cover">
                            <span class="row-name"><?= htmlspecialchars($s['title']) ?></span>
                        </span>
                        <span class="td-style"><span class="badge-tag"><?= htmlspecialchars($s['style']) ?></span></span>
                        <span class="td-plays"><?= number_format($s['plays_count']) ?> plays</span>
                        <span class="td-action" onclick="event.stopPropagation()">
                            <button class="icon-action-btn" onclick="GarbaFavorites.toggle(<?= $s['id'] ?>, this)">❤️</button>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
