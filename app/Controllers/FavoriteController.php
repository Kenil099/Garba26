<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index(): void
    {
        if (!Auth::check()) {
            $this->redirect('/login');
        }

        $favorites = Favorite::getUserFavorites(Auth::id());
        $this->render('my-garba/favorites', [
            'title'     => 'My Favorite Songs - Garba26',
            'favorites' => $favorites,
        ]);
    }

    public function toggle(): void
    {
        if (!Auth::check()) {
            $this->json(['success' => false, 'message' => 'Please log in to save favorites.'], 401);
            return;
        }

        $songId = (int)$this->request->input('song_id');
        $isFavorited = Favorite::toggle(Auth::id(), $songId);

        $this->json([
            'success'     => true,
            'isFavorited' => $isFavorited,
            'message'     => $isFavorited ? 'Added to your favorites ❤️' : 'Removed from favorites',
        ]);
    }
}
