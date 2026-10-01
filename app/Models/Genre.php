<?php
namespace App\Models;

use App\Core\Model;

class Genre extends Model
{
    protected static string $table = 'genres';

    public static function findBySlug(string $slug): ?array
    {
        return static::firstWhere('slug', $slug);
    }

    public static function getWithSongCount(): array
    {
        $sql = "SELECT g.*, COUNT(s.id) as song_count 
                FROM genres g 
                LEFT JOIN songs s ON g.id = s.genre_id 
                GROUP BY g.id 
                ORDER BY song_count DESC";
        return static::getDb()->fetchAll($sql);
    }
}
