<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Song;
use App\Models\Favorite;
use App\Core\Auth;

class SongController extends Controller
{
    public function index(): void
    {
        $songs = Song::all('plays_count DESC', 50);
        $this->render('songs/index', [
            'title' => 'Browse All Garba Songs - Garba26',
            'songs' => $songs,
        ]);
    }

    public function details(array $params): void
    {
        $id = (int)($params['id'] ?? 0);
        $song = Song::findWithDetails($id);

        if (!$song) {
            $this->response->status(404)->view('errors/404');
            return;
        }

        $related = Song::getByStyle($song['style'] ?? '3-Taali', 6);
        $isFavorited = Auth::check() ? Favorite::isFavorited(Auth::id(), $id) : false;

        $this->render('songs/details', [
            'title'       => "{$song['title']} - Garba26",
            'song'        => $song,
            'related'     => $related,
            'isFavorited' => $isFavorited,
        ]);
    }

    public function playInfo(array $params): void
    {
        $id = (int)($params['id'] ?? 0);
        $song = Song::findWithDetails($id);

        if (!$song) {
            $this->json(['success' => false, 'message' => 'Song not found'], 404);
            return;
        }

        $this->json(['success' => true, 'song' => $song]);
    }
}
