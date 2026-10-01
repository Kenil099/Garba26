<?php
namespace App\Models;

use App\Core\Model;

class Playlist extends Model
{
    protected static string $table = 'playlists';

    public static function getUserPlaylists(int $userId): array
    {
        $sql = "SELECT p.*, COUNT(ps.song_id) as track_count 
                FROM playlists p 
                LEFT JOIN playlist_songs ps ON p.id = ps.playlist_id 
                WHERE p.user_id = :uid 
                GROUP BY p.id 
                ORDER BY p.updated_at DESC";
        return static::getDb()->fetchAll($sql, ['uid' => $userId]);
    }

    public static function getPublicPlaylists(int $limit = 8): array
    {
        $sql = "SELECT p.*, u.name as creator_name, COUNT(ps.song_id) as track_count 
                FROM playlists p 
                JOIN users u ON p.user_id = u.id 
                LEFT JOIN playlist_songs ps ON p.id = ps.playlist_id 
                WHERE p.is_public = 1 
                GROUP BY p.id 
                ORDER BY p.id DESC LIMIT " . (int)$limit;
        return static::getDb()->fetchAll($sql);
    }

    public static function getSongs(int $playlistId): array
    {
        $sql = "SELECT s.*, a.name as artist_name, alb.title as album_title, ps.added_at 
                FROM playlist_songs ps 
                JOIN songs s ON ps.song_id = s.id 
                JOIN artists a ON s.artist_id = a.id 
                LEFT JOIN albums alb ON s.album_id = alb.id 
                WHERE ps.playlist_id = :pid 
                ORDER BY ps.added_at ASC";
        return static::getDb()->fetchAll($sql, ['pid' => $playlistId]);
    }

    public static function addSong(int $playlistId, int $songId): bool
    {
        $check = "SELECT id FROM playlist_songs WHERE playlist_id = :pid AND song_id = :sid";
        if (static::getDb()->fetch($check, ['pid' => $playlistId, 'sid' => $songId])) {
            return false;
        }
        static::getDb()->insert('playlist_songs', [
            'playlist_id' => $playlistId,
            'song_id'     => $songId,
            'added_at'    => date('Y-m-d H:i:s'),
        ]);
        return true;
    }

    public static function removeSong(int $playlistId, int $songId): int
    {
        return static::getDb()->delete(
            'playlist_songs',
            'playlist_id = :pid AND song_id = :sid',
            ['pid' => $playlistId, 'sid' => $songId]
        );
    }
}
