<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\History;
use App\Models\Song;

class HistoryController extends Controller
{
    public function index(): void
    {
        if (!Auth::check()) {
            $this->redirect('/login');
        }

        $history = History::getRecent(Auth::id(), 30);
        $this->render('my-garba/recently-played', [
            'title'   => 'Recently Played - Garba26',
            'history' => $history,
        ]);
    }

    public function record(): void
    {
        $songId = (int)$this->request->input('song_id');
        if (Auth::check() && $songId > 0) {
            History::record(Auth::id(), $songId);
        } else {
            Song::incrementPlays($songId);
        }
        $this->json(['success' => true]);
    }
}
