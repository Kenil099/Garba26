<?php
namespace App\Models;

use App\Core\Model;

class Circle extends Model
{
    protected static string $table = 'circles';

    public static function findByCode(string $code): ?array
    {
        $sql = "SELECT c.*, u.name as host_name, s.title as song_title, a.name as artist_name 
                FROM circles c 
                JOIN users u ON c.host_user_id = u.id 
                LEFT JOIN songs s ON c.current_song_id = s.id 
                LEFT JOIN artists a ON s.artist_id = a.id 
                WHERE UPPER(c.code) = UPPER(:code) LIMIT 1";
        return static::getDb()->fetch($sql, ['code' => trim($code)]);
    }

    public static function getMembers(int $circleId): array
    {
        $sql = "SELECT u.id, u.name, u.avatar, cm.joined_at 
                FROM circle_members cm 
                JOIN users u ON cm.user_id = u.id 
                WHERE cm.circle_id = :cid 
                ORDER BY cm.joined_at ASC";
        return static::getDb()->fetchAll($sql, ['cid' => $circleId]);
    }

    public static function getMessages(int $circleId, int $limit = 50): array
    {
        $sql = "SELECT cm.id, cm.message, cm.sent_at, u.id as user_id, u.name as user_name, u.avatar 
                FROM circle_messages cm 
                JOIN users u ON cm.user_id = u.id 
                WHERE cm.circle_id = :cid 
                ORDER BY cm.id ASC LIMIT " . (int)$limit;
        return static::getDb()->fetchAll($sql, ['cid' => $circleId]);
    }

    public static function addMessage(int $circleId, int $userId, string $msg): int
    {
        return static::getDb()->insert('circle_messages', [
            'circle_id' => $circleId,
            'user_id'   => $userId,
            'message'   => htmlspecialchars(trim($msg)),
            'sent_at'   => date('Y-m-d H:i:s'),
        ]);
    }

    public static function syncState(int $circleId, int $songId, float $time, int $isPlaying): void
    {
        static::getDb()->update('circles', [
            'current_song_id' => $songId,
            'current_playback_time' => $time,
            'is_playing' => $isPlaying,
            'updated_at' => date('Y-m-d H:i:s'),
        ], 'id = :cid', ['cid' => $circleId]);
    }
}
