<?php
namespace App\Services;

use App\Models\Song;
use App\Models\Artist;
use App\Models\Album;

class SearchService
{
    public function searchAll(string $query): array
    {
        $term = trim($query);
        if (empty($term)) {
            return ['songs' => [], 'artists' => [], 'albums' => []];
        }

        $songs = Song::search($term, 10);
        $artists = Artist::getDb()->fetchAll(
            "SELECT * FROM artists WHERE name LIKE :q OR genres LIKE :q2 LIMIT 6",
            ['q' => "%{$term}%", 'q2' => "%{$term}%"]
        );
        $albums = Album::getDb()->fetchAll(
            "SELECT alb.*, art.name as artist_name FROM albums alb JOIN artists art ON alb.artist_id = art.id WHERE alb.title LIKE :q LIMIT 6",
            ['q' => "%{$term}%"]
        );

        return [
            'query'   => $term,
            'songs'   => $songs,
            'artists' => $artists,
            'albums'  => $albums,
        ];
    }
}
