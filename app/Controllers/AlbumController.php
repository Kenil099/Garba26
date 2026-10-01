<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index(): void
    {
        $albums = Album::all('release_year DESC', 30);
        $this->render('albums/index', [
            'title'  => 'Albums & Navratri Collections - Garba26',
            'albums' => $albums,
        ]);
    }

    public function details(array $params): void
    {
        $slug = $params['slug'] ?? '';
        $album = Album::findBySlug($slug);

        if (!$album) {
            $this->response->status(404)->view('errors/404');
            return;
        }

        $albumWithArtist = Album::withArtist($album['id']);
        $songs = Album::getSongs($album['id']);

        $this->render('albums/details', [
            'title' => "{$album['title']} - Garba26",
            'album' => $albumWithArtist,
            'songs' => $songs,
        ]);
    }
}
