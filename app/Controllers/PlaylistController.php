<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function index(): void
    {
        if (!Auth::check()) {
            $this->redirect('/login');
        }
        $playlists = Playlist::getUserPlaylists(Auth::id());
        $this->render('playlists/index', [
            'title'     => 'My Playlists - Garba26',
            'playlists' => $playlists,
        ]);
    }

    public function create(): void
    {
        if (!Auth::check()) {
            $this->redirect('/login');
        }
        $this->render('playlists/create', [
            'title' => 'Create New Playlist - Garba26',
        ]);
    }

    public function store(): void
    {
        if (!Auth::check()) {
            $this->redirect('/login');
        }

        $title = trim($this->request->input('title', ''));
        $description = trim($this->request->input('description', ''));

        if (empty($title)) {
            Session::flash('error', 'Playlist title is required.');
            $this->redirect('/playlists/create');
            return;
        }

        $id = Playlist::create([
            'user_id'     => Auth::id(),
            'title'       => $title,
            'description' => $description,
            'cover_image' => '/assets/images/default-album.png',
            'is_public'   => 1,
        ]);

        Session::flash('success', 'Playlist created!');
        $this->redirect("/playlist/{$id}");
    }

    public function details(array $params): void
    {
        $id = (int)($params['id'] ?? 0);
        $playlist = Playlist::find($id);

        if (!$playlist) {
            $this->response->status(404)->view('errors/404');
            return;
        }

        $songs = Playlist::getSongs($id);

        $this->render('playlists/details', [
            'title'    => "{$playlist['title']} - Garba26",
            'playlist' => $playlist,
            'songs'    => $songs,
            'isOwner'  => Auth::check() && Auth::id() === (int)$playlist['user_id'],
        ]);
    }

    public function addSong(): void
    {
        if (!Auth::check()) {
            $this->json(['success' => false, 'message' => 'Please login'], 401);
            return;
        }

        $playlistId = (int)$this->request->input('playlist_id');
        $songId = (int)$this->request->input('song_id');

        $playlist = Playlist::find($playlistId);
        if (!$playlist || (int)$playlist['user_id'] !== Auth::id()) {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 403);
            return;
        }

        $added = Playlist::addSong($playlistId, $songId);
        $this->json([
            'success' => $added,
            'message' => $added ? 'Song added to playlist.' : 'Song already in playlist.',
        ]);
    }

    public function removeSong(): void
    {
        if (!Auth::check()) {
            $this->json(['success' => false, 'message' => 'Please login'], 401);
            return;
        }

        $playlistId = (int)$this->request->input('playlist_id');
        $songId = (int)$this->request->input('song_id');

        $playlist = Playlist::find($playlistId);
        if (!$playlist || (int)$playlist['user_id'] !== Auth::id()) {
            $this->json(['success' => false, 'message' => 'Unauthorized'], 403);
            return;
        }

        Playlist::removeSong($playlistId, $songId);
        $this->json(['success' => true, 'message' => 'Song removed from playlist.']);
    }
}
