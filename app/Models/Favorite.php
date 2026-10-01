<?php
namespace App\Models;

use App\Core\Model;

class Favorite extends Model
{
    protected static string $table = 'favorites';

    public static function isFavorited(int $userId, int $songId): bool
    {
        $sql = "SELECT id FROM favorites WHERE user_id = :uid AND song_id = :sid LIMIT 1";
        return (bool)static::getDb()->fetch($sql, ['uid' => $userId, 'sid' => $songId]);
    }

    public static function toggle(int $userId, int $songId): bool
    {
        if (self::isFavorited($userId, $songId)) {
            static::getDb()->delete('favorites', 'user_id = :uid AND song_id = :sid', ['uid' => $userId, 'sid' => $songId]);
            return false;
        } else {
            static::getDb()->insert('favorites', [
                'user_id' => $userId,
                'song_id' => $songId,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            return true;
        }
    }

    public static function getUserFavorites(int $userId): array
    {
        $sql = "SELECT s.*, a.name as artist_name, alb.title as album_title, f.created_at as favorited_at 
                FROM favorites f 
                JOIN songs s ON f.song_id = s.id 
                JOIN artists a ON s.artist_id = a.id 
                LEFT JOIN albums alb ON s.album_id = alb.id 
                WHERE f.user_id = :uid 
                ORDER BY f.created_at DESC";
        return static::getDb()->fetchAll($sql, ['uid' => $userId]);
    }
}
