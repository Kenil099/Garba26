<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Genre;
use App\Models\Song;

class GenreController extends Controller
{
    public function index(): void
    {
        $genres = Genre::getWithSongCount();
        $this->render('genres/index', [
            'title'  => 'Explore Garba Genres & Styles - Garba26',
            'genres' => $genres,
        ]);
    }

    public function details(array $params): void
    {
        $slug = $params['slug'] ?? '';
        $genre = Genre::findBySlug($slug);

        if (!$genre) {
            $this->response->status(404)->view('errors/404');
            return;
        }

        $songs = Song::where('genre_id', $genre['id'], 'plays_count DESC');

        $this->render('genres/details', [
            'title' => "{$genre['name']} - Garba26",
            'genre' => $genre,
            'songs' => $songs,
        ]);
    }
}
