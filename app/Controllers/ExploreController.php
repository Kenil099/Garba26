<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Song;
use App\Models\Artist;
use App\Models\Genre;

class ExploreController extends Controller
{
    public function index(): void
    {
        $genres = Genre::all();
        $topArtists = Artist::getPopular(6);
        $trendingSongs = Song::getPopular(12);

        $this->render('explore/index', [
            'title'    => 'Explore Heritage & Modern Garba - Garba26',
            'genres'   => $genres,
            'artists'  => $topArtists,
            'trending' => $trendingSongs,
        ]);
    }

    public function styles(array $params = []): void
    {
        $style = $this->request->input('style', '3-Taali');
        $songs = Song::getByStyle($style, 20);

        $this->render('explore/styles', [
            'title'         => "Explore {$style} Style - Garba26",
            'selectedStyle' => $style,
            'songs'         => $songs,
            'styles'        => STYLES,
        ]);
    }

    public function traditions(): void
    {
        $tradition = $this->request->input('tradition', 'United Way');
        $songs = Song::getByTradition($tradition, 20);

        $this->render('explore/traditions', [
            'title'             => "Explore {$tradition} Tradition - Garba26",
            'selectedTradition' => $tradition,
            'songs'             => $songs,
            'traditions'        => TRADITIONS,
        ]);
    }

    public function eras(): void
    {
        $era = $this->request->input('era', 'Traditional');
        $songs = Song::getByEra($era, 20);

        $this->render('explore/eras', [
            'title'       => "Explore {$era} Era - Garba26",
            'selectedEra' => $era,
            'songs'       => $songs,
            'eras'        => ERAS,
        ]);
    }

    public function catalogue(): void
    {
        $allSongs = Song::all('plays_count DESC', 50);
        $this->render('explore/catalogue', [
            'title' => 'Complete Garba Catalogue - Garba26',
            'songs' => $allSongs,
        ]);
    }
}
