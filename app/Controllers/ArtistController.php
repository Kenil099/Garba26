<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function index(): void
    {
        $artists = Artist::getPopular(24);
        $this->render('artists/index', [
            'title'   => 'Legendary Garba & Folk Artists - Garba26',
            'artists' => $artists,
        ]);
    }

    public function details(array $params): void
    {
        $slug = $params['slug'] ?? '';
        $artist = Artist::findBySlug($slug);

        if (!$artist) {
            $this->response->status(404)->view('errors/404');
            return;
        }

        $songs = Artist::getSongs($artist['id']);
        $albums = Artist::getAlbums($artist['id']);

        $this->render('artists/details', [
            'title'  => "{$artist['name']} - Garba26",
            'artist' => $artist,
            'songs'  => $songs,
            'albums' => $albums,
        ]);
    }
}
