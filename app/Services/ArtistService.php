<?php
namespace App\Services;

use App\Models\Artist;

class ArtistService
{
    public function getTopArtists(int $limit = 8): array
    {
        return Artist::getPopular($limit);
    }

    public function getArtistPage(string $slug): ?array
    {
        $artist = Artist::findBySlug($slug);
        if (!$artist) {
            return null;
        }
        $songs = Artist::getSongs($artist['id']);
        $albums = Artist::getAlbums($artist['id']);
        return [
            'artist' => $artist,
            'songs'  => $songs,
            'albums' => $albums,
        ];
    }
}
