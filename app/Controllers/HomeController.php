<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Song;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Playlist;
use App\Models\Genre;

class HomeController extends Controller
{
    public function index(): void
    {
        $featured = Song::getFeatured(6);
        $popular = Song::getPopular(10);
        $artists = Artist::getPopular(8);
        $albums = Album::all('release_year DESC', 6);
        $genres = Genre::all('id ASC', 8);
        $publicPlaylists = Playlist::getPublicPlaylists(6);
        $twoTaali = Song::getByStyle('2-Taali', 6);
        $threeTaali = Song::getByStyle('3-Taali', 6);
        $unitedWay = Song::getByTradition('United Way', 6);

        $this->render('home/index', [
            'title'           => 'Garba26 - The Ultimate Garba & Folk Audio Streaming Experience',
            'featured'        => $featured,
            'popular'         => $popular,
            'artists'         => $artists,
            'albums'          => $albums,
            'genres'          => $genres,
            'publicPlaylists' => $publicPlaylists,
            'twoTaali'        => $twoTaali,
            'threeTaali'      => $threeTaali,
            'unitedWay'       => $unitedWay,
        ]);
    }
}
