<?php
namespace App\Services;

use App\Models\Favorite;

class FavoriteService
{
    public function toggleFavorite(int $userId, int $songId): bool
    {
        return Favorite::toggle($userId, $songId);
    }

    public function getUserFavorites(int $userId): array
    {
        return Favorite::getUserFavorites($userId);
    }
}
