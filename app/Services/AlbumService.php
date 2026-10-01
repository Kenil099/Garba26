<?php
namespace App\Services;

use App\Models\Album;

class AlbumService
{
    public function getAlbumDetails(string $slug): ?array
    {
        $album = Album::findBySlug($slug);
        if (!$album) {
            return null;
        }
        $albumDetails = Album::withArtist($album['id']);
        $songs = Album::getSongs($album['id']);
        return [
            'album' => $albumDetails,
            'songs' => $songs,
        ];
    }
}
