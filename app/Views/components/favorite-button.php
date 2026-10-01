<!-- app/Views/components/favorite-button.php -->
<button class="icon-action-btn" onclick="GarbaFavorites.toggle(<?= $songId ?>, this)" title="Favorite">
    <?= ($isFavorited ?? false) ? '❤️' : '🤍' ?>
</button>
