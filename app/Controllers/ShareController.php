<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Song;
use App\Models\Artist;
use App\Models\Playlist;

class ShareController extends Controller
{
    public function getMeta(): void
    {
        $type = $this->request->input('type', 'song');
        $id = (int)$this->request->input('id', 0);

        $url = APP_URL;
        $title = SITE_NAME;
        $text = "Listen to authentic Garba on Garba26!";

        if ($type === 'song') {
            $song = Song::findWithDetails($id);
            if ($song) {
                $title = "{$song['title']} by {$song['artist_name']}";
                $url = APP_URL . "/song/{$song['id']}";
                $text = "Check out '{$song['title']}' on Garba26 - The Ultimate Garba Platform!";
            }
        }

        $this->json([
            'success' => true,
            'title'   => $title,
            'url'     => $url,
            'text'    => $text,
        ]);
    }
}
