<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Playlist;
use App\Models\History;

class UserController extends Controller
{
    public function profile(): void
    {
        $user = Auth::user();
        if (!$user) {
            $this->redirect('/login');
        }

        $favorites = Favorite::getUserFavorites($user['id']);
        $playlists = Playlist::getUserPlaylists($user['id']);
        $recentHistory = History::getRecent($user['id'], 5);

        $this->render('profile/index', [
            'title'     => 'My Profile - Garba26',
            'user'      => $user,
            'favorites' => $favorites,
            'playlists' => $playlists,
            'history'   => $recentHistory,
        ]);
    }

    public function edit(): void
    {
        $this->render('profile/edit', [
            'title' => 'Edit Profile - Garba26',
            'user'  => Auth::user(),
        ]);
    }

    public function update(): void
    {
        $userId = Auth::id();
        $name = trim($this->request->input('name', ''));
        $bio = trim($this->request->input('bio', ''));

        User::update($userId, [
            'name' => $name,
            'bio'  => $bio,
        ]);

        $updatedUser = User::find($userId);
        Auth::login($updatedUser);

        Session::flash('success', 'Profile updated successfully.');
        $this->redirect('/profile');
    }

    public function settings(): void
    {
        $this->render('profile/settings', [
            'title' => 'Account Settings - Garba26',
            'user'  => Auth::user(),
        ]);
    }

    public function security(): void
    {
        $this->render('profile/security', [
            'title' => 'Security & Privacy - Garba26',
            'user'  => Auth::user(),
        ]);
    }
}
