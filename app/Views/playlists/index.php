<!-- app/Views/playlists/index.php -->
<div class="playlists-index-page">
    <div class="page-title-bar flex-between">
        <div>
            <h1>My Garba Playlists</h1>
            <p>Custom collections for every round and stage.</p>
        </div>
        <a href="/playlists/create" class="btn btn-primary">+ Create New Playlist</a>
    </div>

    <div class="cards-grid mt-4">
        <?php foreach ($playlists as $pl): ?>
            <a href="/playlist/<?= $pl['id'] ?>" class="song-card-item">
                <div class="card-cover-wrapper">
                    <img src="<?= htmlspecialchars($pl['cover_image'] ?? '/assets/images/default-album.png') ?>" alt="Cover" class="card-img">
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?= htmlspecialchars($pl['title']) ?></h4>
                    <span class="card-subtitle"><?= $pl['track_count'] ?? 0 ?> tracks</span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
