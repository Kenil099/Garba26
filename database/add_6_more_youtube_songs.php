<?php
define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/config/constants.php';

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = ROOT_PATH . '/app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    if (file_exists($file)) require $file;
});

use App\Core\Database;

$db = Database::getInstance();

echo "Starting 6 new YouTube Garba integration...\n";

function getOrCreateArtist($db, $name, $slug, $image, $bio, $genres = 'Garba, Folk') {
    $existing = $db->fetch("SELECT id FROM artists WHERE slug = :slug OR name = :name LIMIT 1", [
        'slug' => $slug,
        'name' => $name
    ]);
    if ($existing) {
        return (int)$existing['id'];
    }
    $id = $db->insert('artists', [
        'name' => $name,
        'slug' => $slug,
        'image' => $image,
        'banner' => $image,
        'bio' => $bio,
        'genres' => $genres,
        'monthly_listeners' => rand(150000, 750000),
        'is_verified' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    echo "Created artist: {$name} (ID: {$id})\n";
    return (int)$id;
}

function getOrCreateAlbum($db, $title, $slug, $artistId, $coverImage, $desc) {
    $existing = $db->fetch("SELECT id FROM albums WHERE slug = :slug OR title = :title LIMIT 1", [
        'slug' => $slug,
        'title' => $title
    ]);
    if ($existing) {
        return (int)$existing['id'];
    }
    $id = $db->insert('albums', [
        'title' => $title,
        'slug' => $slug,
        'artist_id' => $artistId,
        'cover_image' => $coverImage,
        'release_year' => 2026,
        'description' => $desc,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    echo "Created album: {$title} (ID: {$id})\n";
    return (int)$id;
}

// 1. Artists
$amitTrivediId = getOrCreateArtist($db, 'Amit Trivedi & Osman Mir', 'amit-trivedi-osman-mir', 'https://i.ytimg.com/vi/Jv8KRwF1zQs/hqdefault.jpg', 'National award-winning composer Amit Trivedi collaborating with Osman Mir for breathtaking folk transcendence.', 'Modern Fusion, Sufi Folk, Garba');
$herryNakumId = getOrCreateArtist($db, 'Herry Nakum', 'herry-nakum', 'https://i.ytimg.com/vi/B4qSyd48zTs/hqdefault.jpg', 'Acclaimed folk artist known for authentic flute cadences and soulful traditional Saurashtra garba.', '2-Taali, Folk, Traditional');
$maheshsinhId = getOrCreateArtist($db, 'Maheshsinh Solanki', 'maheshsinh-solanki', 'https://i.ytimg.com/vi/atKTqi9ID7A/hqdefault.jpg', 'Powerful devotional and folk vocalist celebrating the divine aura of Maa Ambe.', 'Aradhiya, Stuti, Folk');
$zeelJoshiId = getOrCreateArtist($db, 'Zeel Joshi', 'zeel-joshi', 'https://i.ytimg.com/vi/s-QIqX0sjSs/hqdefault.jpg', 'Vibrant festive singer delivering fast-paced 3-Taali beats and crowd-pleasing Navratri tracks.', '3-Taali, Dandiya Raas, Modern');

// 2. Albums
$motiAlbumId = getOrCreateAlbum($db, 'Songs of Faith & Folk Transcendence', 'songs-of-faith-folk-transcendence', $amitTrivediId, 'https://i.ytimg.com/vi/Jv8KRwF1zQs/hqdefault.jpg', 'Spiritual heights and festive celebration blended with modern orchestral folk.');
$morliAlbumId = getOrCreateAlbum($db, 'Mathura Ni Morli Rasotsav', 'mathura-ni-morli-rasotsav', $herryNakumId, 'https://i.ytimg.com/vi/B4qSyd48zTs/hqdefault.jpg', 'Melodious Krishna-Radha raas collection steeped in pure Gujarati countryside charm.');
$ambaAlbumId = getOrCreateAlbum($db, 'Amba Tu Aavje Maa Aradhiya', 'amba-tu-aavje-maa-aradhiya', $maheshsinhId, 'https://i.ytimg.com/vi/atKTqi9ID7A/hqdefault.jpg', 'Devotional garba hymns invoking blessing, health, and spiritual celebration.');
$garbeRamvaAlbumId = getOrCreateAlbum($db, 'Garbe Ramva Jau Mare Live', 'garbe-ramva-jau-mare-live', $zeelJoshiId, 'https://i.ytimg.com/vi/s-QIqX0sjSs/hqdefault.jpg', 'Electrifying continuous dandiya raas rhythms designed for high-energy ground dancing.');

// 3. Songs list
$newSongs = [
    // 1. Mathura Ma Vagi Morli
    [
        'title' => 'Mathura Ma Vagi Morli',
        'slug' => 'mathura-ma-vagi-morli',
        'artist_id' => $herryNakumId,
        'album_id' => $morliAlbumId,
        'genre_id' => 1, // 2-Taali
        'duration' => 239,
        'audio_url' => 'https://youtu.be/B4qSyd48zTs',
        'youtube_id' => 'B4qSyd48zTs',
        'cover_image' => 'https://i.ytimg.com/vi/B4qSyd48zTs/hqdefault.jpg',
        'style' => '2-Taali',
        'era' => 'Traditional',
        'tradition' => 'Saurashtra',
        'lyrics' => "મથુરા માં વાગી મોરલી ને ગોકુળ માં થયો નાદ રે...\nવાંસળી ના સૂરે રાધા ઘેલી થઈ, કાના સંગ ગરબે ઘૂમે રે!\nહે કાનુડા તારા દર્શન કાજે હૈયું મારું તલસે રે.",
        'plays_count' => 380000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 2. Amba Tu Aavje Maa
    [
        'title' => 'Amba Tu Aavje Maa',
        'slug' => 'amba-tu-aavje-maa',
        'artist_id' => $maheshsinhId,
        'album_id' => $ambaAlbumId,
        'genre_id' => 7, // Aradhiya
        'duration' => 296,
        'audio_url' => 'https://youtu.be/atKTqi9ID7A',
        'youtube_id' => 'atKTqi9ID7A',
        'cover_image' => 'https://i.ytimg.com/vi/atKTqi9ID7A/hqdefault.jpg',
        'style' => 'Aradhiya',
        'era' => 'Modern',
        'tradition' => 'Maa Ambe Stuti',
        'lyrics' => "અંબા તું આવજે માં, ગરબે રમવા આવજે માં...\nભક્તો ના આંગણિયે દીવડા પ્રગટ્યા, આશીર્વાદ વરસાવજે માં!\nકષ્ટ હરનારી તું માવડી, સદાય રક્ષા કરજે માં.",
        'plays_count' => 420000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 3. Phoolde Shangaru Maa Tari Chundadi
    [
        'title' => 'Phoolde Shangaru Maa Tari Chundadi',
        'slug' => 'phoolde-shangaru-maa-tari-chundadi',
        'artist_id' => 7, // Hemant Chauhan / Shreyas
        'album_id' => 7, // Maa Ambe Aradhiya Sangrah
        'genre_id' => 7, // Aradhiya
        'duration' => 578,
        'audio_url' => 'https://youtu.be/zfx85YYAFjU',
        'youtube_id' => 'zfx85YYAFjU',
        'cover_image' => 'https://i.ytimg.com/vi/zfx85YYAFjU/hqdefault.jpg',
        'style' => 'Aradhiya',
        'era' => 'Traditional',
        'tradition' => 'Maa Ambe Stuti',
        'lyrics' => "ફૂલડે શણગારું માં તારી ચુંદડી...\nમોતીડે મઢાવું તારો ચૂડલો રે!\nગબ્બર વાળી માવડી, તારા પગલે કંકુ ના છાંટણાં રે.",
        'plays_count' => 510000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 4. Garbe Ramva Jau Mare
    [
        'title' => 'Garbe Ramva Jau Mare',
        'slug' => 'garbe-ramva-jau-mare',
        'artist_id' => $zeelJoshiId,
        'album_id' => $garbeRamvaAlbumId,
        'genre_id' => 2, // 3-Taali
        'duration' => 319,
        'audio_url' => 'https://youtu.be/s-QIqX0sjSs',
        'youtube_id' => 's-QIqX0sjSs',
        'cover_image' => 'https://i.ytimg.com/vi/s-QIqX0sjSs/hqdefault.jpg',
        'style' => '3-Taali',
        'era' => 'Modern',
        'tradition' => 'Ahmedabad',
        'lyrics' => "ગરબે રમવા જાઉં મારે, ઢોલ ના તાલે ઝૂમવું છે...\nઝાંઝરિયું ઝમકે પગલે પગલે, ચોગાળા સંગ ઘૂમવું છે!\nચાલો સખીઓ ગરબા ના ચોક માં રાસ રમીએ રે.",
        'plays_count' => 360000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 5. Garbe Goomva De
    [
        'title' => 'Garbe Goomva De',
        'slug' => 'garbe-goomva-de',
        'artist_id' => 3, // Kinjal Dave / Bhaktivani
        'album_id' => 4, // Char Char Bangadi Melodies
        'genre_id' => 1, // 2-Taali
        'duration' => 311,
        'audio_url' => 'https://youtu.be/lmk3idf_e8s',
        'youtube_id' => 'lmk3idf_e8s',
        'cover_image' => 'https://i.ytimg.com/vi/lmk3idf_e8s/hqdefault.jpg',
        'style' => '2-Taali',
        'era' => 'Modern',
        'tradition' => 'Saurashtra',
        'lyrics' => "ગરબે ઘૂમવા દે મને ગરબે ઘૂમવા દે...\nનવ નવ રાત ની રઢીયાળી રમઝટ માં મહાલવા દે!\nઅંબા મા ના ગરબે ઘૂમી હૈયું હરખાય રે.",
        'plays_count' => 395000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 6. Moti Veraana
    [
        'title' => 'Moti Veraana (Songs of Faith)',
        'slug' => 'moti-veraana-songs-of-faith',
        'artist_id' => $amitTrivediId,
        'album_id' => $motiAlbumId,
        'genre_id' => 8, // Modern Fusion
        'duration' => 238,
        'audio_url' => 'https://youtu.be/Jv8KRwF1zQs',
        'youtube_id' => 'Jv8KRwF1zQs',
        'cover_image' => 'https://i.ytimg.com/vi/Jv8KRwF1zQs/hqdefault.jpg',
        'style' => 'Hech',
        'era' => 'Modern',
        'tradition' => 'Saurashtra',
        'lyrics' => "મોતી વેરાણા ચોક માં, માવડી પધાર્યા આંગણે...\nતાલી ના તાલે ગૂંજે સંસાર, હે માવડી તારી અસીમ કૃપા!\nઆજ રે આનંદ મારે આંગણે ઉમટ્યો રે.",
        'plays_count' => 950000,
        'is_featured' => 1,
        'is_popular' => 1
    ]
];

$addedIds = [];

foreach ($newSongs as $s) {
    $existing = $db->fetch("SELECT id FROM songs WHERE youtube_id = :yt OR audio_url LIKE :url LIMIT 1", [
        'yt' => $s['youtube_id'],
        'url' => '%' . $s['youtube_id'] . '%'
    ]);

    if ($existing) {
        $songId = $existing['id'];
        $db->update('songs', [
            'title' => $s['title'],
            'slug' => $s['slug'],
            'artist_id' => $s['artist_id'],
            'album_id' => $s['album_id'],
            'genre_id' => $s['genre_id'],
            'duration' => $s['duration'],
            'audio_url' => $s['audio_url'],
            'youtube_id' => $s['youtube_id'],
            'cover_image' => $s['cover_image'],
            'style' => $s['style'],
            'era' => $s['era'],
            'tradition' => $s['tradition'],
            'lyrics' => $s['lyrics'],
            'plays_count' => $s['plays_count'],
            'is_featured' => $s['is_featured'],
            'is_popular' => $s['is_popular'],
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = :id', ['id' => $songId]);
        echo "Updated Song #{$songId}: {$s['title']} (YT: {$s['youtube_id']})\n";
    } else {
        $songId = $db->insert('songs', [
            'title' => $s['title'],
            'slug' => $s['slug'],
            'artist_id' => $s['artist_id'],
            'album_id' => $s['album_id'],
            'genre_id' => $s['genre_id'],
            'duration' => $s['duration'],
            'audio_url' => $s['audio_url'],
            'youtube_id' => $s['youtube_id'],
            'cover_image' => $s['cover_image'],
            'style' => $s['style'],
            'era' => $s['era'],
            'tradition' => $s['tradition'],
            'lyrics' => $s['lyrics'],
            'plays_count' => $s['plays_count'],
            'is_featured' => $s['is_featured'],
            'is_popular' => $s['is_popular'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        echo "Inserted Song #{$songId}: {$s['title']} (YT: {$s['youtube_id']})\n";
    }

    $addedIds[] = $songId;

    // Add to playlists
    $db->query("INSERT OR IGNORE INTO playlist_songs (playlist_id, song_id) VALUES (2, :sid)", ['sid' => $songId]);
    $db->query("INSERT OR IGNORE INTO playlist_songs (playlist_id, song_id) VALUES (3, :sid)", ['sid' => $songId]);
    $db->query("INSERT OR IGNORE INTO favorites (user_id, song_id) VALUES (1, :sid)", ['sid' => $songId]);
}

echo "\nFinished adding all " . count($addedIds) . " new songs!\n";
