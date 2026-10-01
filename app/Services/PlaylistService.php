<?php
namespace App\Services;

use App\Models\Playlist;

class PlaylistService
{
    public function getUserPlaylists(int $userId): array
    {
        return Playlist::getUserPlaylists($userId);
    }

    public function createPlaylist(int $userId, string $title, ?string $description = ''): int
    {
        return Playlist::create([
            'user_id'     => $userId,
            'title'       => trim($title),
            'description' => trim($description),
            'cover_image' => '/assets/images/default-album.png',
            'is_public'   => 1,
        ]);
    }
}
