<!-- app/Views/components/artist-card.php -->
<a href="/artist/<?= htmlspecialchars($artist['slug']) ?>" class="artist-card-item">
    <div class="artist-avatar-wrap">
        <img src="<?= htmlspecialchars($artist['image'] ?? '/assets/images/default-avatar.png') ?>" alt="Artist" class="artist-img">
    </div>
    <h4 class="artist-name"><?= htmlspecialchars($artist['name']) ?></h4>
</a>
