<?php
namespace App\Models;

use App\Core\Model;

class Song extends Model
{
    protected static string $table = 'songs';

    public static function findWithDetails(int $id): ?array
    {
        $sql = "SELECT s.*, a.name as artist_name, a.image as artist_image, 
                       alb.title as album_title, alb.cover_image as album_cover,
                       g.name as genre_name 
                FROM songs s 
                JOIN artists a ON s.artist_id = a.id 
                LEFT JOIN albums alb ON s.album_id = alb.id 
                LEFT JOIN genres g ON s.genre_id = g.id 
                WHERE s.id = :id LIMIT 1";
        return static::getDb()->fetch($sql, ['id' => $id]);
    }

    public static function allWithDetails(string $orderBy = 's.is_featured DESC, s.plays_count DESC', ?int $limit = 50): array
    {
        $sql = "SELECT s.*, a.name as artist_name, a.image as artist_image, alb.title as album_title 
                FROM songs s 
                JOIN artists a ON s.artist_id = a.id 
                LEFT JOIN albums alb ON s.album_id = alb.id 
                ORDER BY " . $orderBy;
        if ($limit !== null) {
            $sql .= " LIMIT " . (int)$limit;
        }
        return static::getDb()->fetchAll($sql);
    }

    public static function getFeatured(int $limit = 6): array
    {
        $sql = "SELECT s.*, a.name as artist_name, alb.title as album_title 
                FROM songs s 
                JOIN artists a ON s.artist_id = a.id 
                LEFT JOIN albums alb ON s.album_id = alb.id 
                WHERE s.is_featured = 1 
                ORDER BY s.plays_count DESC LIMIT " . (int)$limit;
        return static::getDb()->fetchAll($sql);
    }

    public static function getPopular(int $limit = 10): array
    {
        $sql = "SELECT s.*, a.name as artist_name, alb.title as album_title 
                FROM songs s 
                JOIN artists a ON s.artist_id = a.id 
                LEFT JOIN albums alb ON s.album_id = alb.id 
                ORDER BY s.plays_count DESC LIMIT " . (int)$limit;
        return static::getDb()->fetchAll($sql);
    }

    public static function getByStyle(string $style, int $limit = 12): array
    {
        $sql = "SELECT s.*, a.name as artist_name 
                FROM songs s 
                JOIN artists a ON s.artist_id = a.id 
                WHERE s.style = :style 
                ORDER BY s.plays_count DESC LIMIT " . (int)$limit;
        return static::getDb()->fetchAll($sql, ['style' => $style]);
    }

    public static function getByTradition(string $tradition, int $limit = 12): array
    {
        $sql = "SELECT s.*, a.name as artist_name 
                FROM songs s 
                JOIN artists a ON s.artist_id = a.id 
                WHERE s.tradition = :tradition 
                ORDER BY s.plays_count DESC LIMIT " . (int)$limit;
        return static::getDb()->fetchAll($sql, ['tradition' => $tradition]);
    }

    public static function getByEra(string $era, int $limit = 12): array
    {
        $sql = "SELECT s.*, a.name as artist_name 
                FROM songs s 
                JOIN artists a ON s.artist_id = a.id 
                WHERE s.era = :era 
                ORDER BY s.plays_count DESC LIMIT " . (int)$limit;
        return static::getDb()->fetchAll($sql, ['era' => $era]);
    }

    public static function search(string $term, int $limit = 20): array
    {
        $termLike = '%' . $term . '%';
        $sql = "SELECT s.*, a.name as artist_name, alb.title as album_title 
                FROM songs s 
                JOIN artists a ON s.artist_id = a.id 
                LEFT JOIN albums alb ON s.album_id = alb.id 
                WHERE s.title LIKE :term1 
                   OR a.name LIKE :term2 
                   OR s.style LIKE :term3 
                   OR s.tradition LIKE :term4 
                ORDER BY s.plays_count DESC LIMIT " . (int)$limit;
        return static::getDb()->fetchAll($sql, [
            'term1' => $termLike,
            'term2' => $termLike,
            'term3' => $termLike,
            'term4' => $termLike,
        ]);
    }

    public static function incrementPlays(int $id): void
    {
        $sql = "UPDATE songs SET plays_count = plays_count + 1 WHERE id = :id";
        static::getDb()->query($sql, ['id' => $id]);
    }
}
