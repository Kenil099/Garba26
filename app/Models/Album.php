<?php
namespace App\Models;

use App\Core\Model;

class Album extends Model
{
    protected static string $table = 'albums';

    public static function findBySlug(string $slug): ?array
    {
        return static::firstWhere('slug', $slug);
    }

    public static function withArtist(int $albumId): ?array
    {
        $sql = "SELECT alb.*, art.name as artist_name, art.image as artist_image 
                FROM albums alb 
                JOIN artists art ON alb.artist_id = art.id 
                WHERE alb.id = :id LIMIT 1";
        return static::getDb()->fetch($sql, ['id' => $albumId]);
    }

    public static function getSongs(int $albumId): array
    {
        $sql = "SELECT s.*, a.name as artist_name 
                FROM songs s 
                JOIN artists a ON s.artist_id = a.id 
                WHERE s.album_id = :id 
                ORDER BY s.id ASC";
        return static::getDb()->fetchAll($sql, ['id' => $albumId]);
    }
}
