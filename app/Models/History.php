<?php
namespace App\Models;

use App\Core\Model;

class History extends Model
{
    protected static string $table = 'history';

    public static function record(int $userId, int $songId): void
    {
        static::getDb()->insert('history', [
            'user_id' => $userId,
            'song_id' => $songId,
            'played_at' => date('Y-m-d H:i:s'),
        ]);
        Song::incrementPlays($songId);
    }

    public static function getRecent(int $userId, int $limit = 15): array
    {
        $sql = "SELECT s.*, a.name as artist_name, alb.title as album_title, h.played_at 
                FROM history h 
                JOIN songs s ON h.song_id = s.id 
                JOIN artists a ON s.artist_id = a.id 
                LEFT JOIN albums alb ON s.album_id = alb.id 
                WHERE h.user_id = :uid 
                ORDER BY h.played_at DESC LIMIT " . (int)$limit;
        return static::getDb()->fetchAll($sql, ['uid' => $userId]);
    }
}
