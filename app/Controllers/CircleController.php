<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Models\Circle;
use App\Models\CircleMember;
use App\Models\Song;

class CircleController extends Controller
{
    public function index(): void
    {
        $circles = Circle::all('id DESC', 10);
        $this->render('circle/index', [
            'title'   => 'Garba Circle - Synchronized Listening Rooms',
            'circles' => $circles,
        ]);
    }

    public function create(): void
    {
        if (!Auth::check()) {
            $this->redirect('/login');
        }
        $this->render('circle/create', [
            'title' => 'Create a Garba Circle - Garba26',
        ]);
    }

    public function store(): void
    {
        if (!Auth::check()) {
            $this->redirect('/login');
        }

        $name = trim($this->request->input('name', 'My Garba Room'));
        $code = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));

        $id = Circle::create([
            'code'                  => $code,
            'name'                  => $name,
            'host_user_id'          => Auth::id(),
            'current_song_id'       => 1, // Default starting track
            'current_playback_time' => 0.0,
            'is_playing'            => 0,
        ]);

        CircleMember::join($id, Auth::id());
        $this->redirect("/circle/room/{$code}");
    }

    public function join(): void
    {
        $code = strtoupper(trim($this->request->input('code', '')));
        $circle = Circle::findByCode($code);

        if (!$circle) {
            Session::flash('error', 'Invalid Circle code. Please try again.');
            $this->redirect('/circle');
            return;
        }

        if (Auth::check()) {
            CircleMember::join($circle['id'], Auth::id());
        }

        $this->redirect("/circle/room/{$circle['code']}");
    }

    public function room(array $params): void
    {
        $code = strtoupper($params['code'] ?? '');
        $circle = Circle::findByCode($code);

        if (!$circle) {
            $this->response->status(404)->view('errors/404');
            return;
        }

        if (Auth::check()) {
            CircleMember::join($circle['id'], Auth::id());
        }

        $members = Circle::getMembers($circle['id']);
        $messages = Circle::getMessages($circle['id'], 30);
        $currentSong = $circle['current_song_id'] ? Song::findWithDetails($circle['current_song_id']) : null;
        $isHost = Auth::check() && Auth::id() === (int)$circle['host_user_id'];

        $this->render('circle/room', [
            'title'       => "Garba Circle: {$circle['name']} - Garba26",
            'circle'      => $circle,
            'members'     => $members,
            'messages'    => $messages,
            'currentSong' => $currentSong,
            'isHost'      => $isHost,
        ]);
    }

    public function syncState(): void
    {
        $code = $this->request->input('code');
        $circle = Circle::findByCode($code);

        if (!$circle) {
            $this->json(['success' => false, 'message' => 'Room not found'], 404);
            return;
        }

        // If host is sending updates
        if (Auth::check() && Auth::id() === (int)$circle['host_user_id']) {
            $songId = (int)$this->request->input('song_id', $circle['current_song_id']);
            $time = (float)$this->request->input('time', $circle['current_playback_time']);
            $isPlaying = (int)$this->request->input('is_playing', $circle['is_playing']);

            Circle::syncState($circle['id'], $songId, $time, $isPlaying);
        }

        // Return latest updated state
        $updated = Circle::findByCode($code);
        $members = Circle::getMembers($circle['id']);
        $messages = Circle::getMessages($circle['id'], 30);

        $this->json([
            'success'   => true,
            'circle'    => $updated,
            'members'   => $members,
            'messages'  => $messages,
        ]);
    }

    public function postMessage(): void
    {
        if (!Auth::check()) {
            $this->json(['success' => false, 'message' => 'Please log in to chat'], 401);
            return;
        }

        $code = $this->request->input('code');
        $msg = $this->request->input('message');
        $circle = Circle::findByCode($code);

        if (!$circle || empty(trim($msg))) {
            $this->json(['success' => false], 400);
            return;
        }

        Circle::addMessage($circle['id'], Auth::id(), $msg);
        $this->json(['success' => true]);
    }
}
