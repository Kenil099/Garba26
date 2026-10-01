<?php
namespace App\Models;

use App\Core\Model;

class Artist extends Model
{
    protected static string $table = 'artists';

    public static function findBySlug(string $slug): ?array
    {
        return static::firstWhere('slug', $slug);
    }

    public static function getPopular(int $limit = 8): array
    {
        $sql = "SELECT * FROM artists ORDER BY monthly_listeners DESC LIMIT " . (int)$limit;
        return static::getDb()->fetchAll($sql);
    }

    public static function getSongs(int $artistId): array
    {
        $sql = "SELECT s.*, a.name as artist_name, alb.title as album_title 
                FROM songs s 
                JOIN artists a ON s.artist_id = a.id 
                LEFT JOIN albums alb ON s.album_id = alb.id 
                WHERE s.artist_id = :id 
                ORDER BY s.plays_count DESC";
        return static::getDb()->fetchAll($sql, ['id' => $artistId]);
    }

    public static function getAlbums(int $artistId): array
    {
        $sql = "SELECT * FROM albums WHERE artist_id = :id ORDER BY release_year DESC";
        return static::getDb()->fetchAll($sql, ['id' => $artistId]);
    }
}
