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

echo "Starting YouTube Garba integration...\n";

// 1. Ensure youtube_id column exists in songs table
try {
    $cols = $db->fetchAll("PRAGMA table_info(songs)");
    $hasYtCol = false;
    foreach ($cols as $c) {
        if ($c['name'] === 'youtube_id') {
            $hasYtCol = true;
            break;
        }
    }
    if (!$hasYtCol) {
        $db->query("ALTER TABLE songs ADD COLUMN youtube_id VARCHAR(50) DEFAULT NULL");
        echo "Added youtube_id column.\n";
    }
} catch (Exception $e) {
    echo "Note on schema: " . $e->getMessage() . "\n";
}

// 2. Helper to get or create artist
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
        'monthly_listeners' => rand(150000, 650000),
        'is_verified' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    echo "Created artist: {$name} (ID: {$id})\n";
    return (int)$id;
}

// 3. Helper to get or create album
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

// Create new artists if needed
$darshanId = getOrCreateArtist($db, 'Darshan Raval', 'darshan-raval', 'https://i.ytimg.com/vi/yr7JFNsz5dU/hqdefault.jpg', 'Heartthrob playback maestro redefining modern Garba and festive pop.', 'Modern Fusion, Pop, Garba');
$sachinJigarId = getOrCreateArtist($db, 'Sachin-Jigar', 'sachin-jigar', 'https://i.ytimg.com/vi/tTfF5klskmo/hqdefault.jpg', 'Iconic Gujarati composer duo combining authentic folk instruments with arena soundscapes.', 'Modern Fusion, Folk, Garba');
$rupalDoshiId = getOrCreateArtist($db, 'Rupal Doshi', 'rupal-doshi', 'https://i.ytimg.com/vi/lPO7G8wlCqQ/hqdefault.jpg', 'Soulful traditional Garba singer known for high-octane dhol and classic raas melodies.', '2-Taali, Dandiya, Folk');
$hemaDesaiId = getOrCreateArtist($db, 'Hema Desai', 'hema-desai', 'https://i.ytimg.com/vi/CJRGtgQBxno/hqdefault.jpg', 'Legendary Gujarati folk and devotional vocalist whose stutis grace temples across Gujarat.', 'Aradhiya, Stuti, Traditional');

// Create albums
$darshanAlbumId = getOrCreateAlbum($db, 'Loveyatri & Urban Garba Nights', 'loveyatri-urban-garba-nights', $darshanId, 'https://i.ytimg.com/vi/yr7JFNsz5dU/hqdefault.jpg', 'Modern festival anthems that spark fireworks on every dancefloor.');
$sachinJigarAlbumId = getOrCreateAlbum($db, 'Aavjo Re Shamliya Live', 'aavjo-re-shamliya-live', $sachinJigarId, 'https://i.ytimg.com/vi/tTfF5klskmo/hqdefault.jpg', 'Contemporary Gujarati compositions blending rich tradition with dynamic orchestral energy.');
$rupalAlbumId = getOrCreateAlbum($db, 'Dholida Express Nonstop', 'dholida-express-nonstop', $rupalDoshiId, 'https://i.ytimg.com/vi/lPO7G8wlCqQ/hqdefault.jpg', 'Uninterrupted traditional dhol rhythms and fast-paced claps.');
$hemaAlbumId = getOrCreateAlbum($db, 'Bhakti Vandana & Garbe Ramva Aavo', 'bhakti-vandana-garbe-ramva-aavo', $hemaDesaiId, 'https://i.ytimg.com/vi/CJRGtgQBxno/hqdefault.jpg', 'Revered devotional offerings invoking Maa Ambe and Pavagadh Mahakali.');

// The 13 YouTube videos
$songsToProcess = [
    // 1. Dholida Dhol Re Vagad
    [
        'match_id' => 12,
        'title' => 'Dholida Dhol Re Vagad',
        'slug' => 'dholida-dhol-re-vagad',
        'artist_id' => $rupalDoshiId,
        'album_id' => $rupalAlbumId,
        'genre_id' => 3, // Dandiya Raas
        'duration' => 481,
        'audio_url' => 'https://youtu.be/lPO7G8wlCqQ',
        'youtube_id' => 'lPO7G8wlCqQ',
        'cover_image' => 'https://i.ytimg.com/vi/lPO7G8wlCqQ/hqdefault.jpg',
        'style' => 'Raas',
        'era' => 'Modern',
        'tradition' => 'Ahmedabad',
        'lyrics' => "ઢોલીડા ઢોલ રે વગાડ મારે હિંચ લેવી છે...\nઢોલ ના તાલે ઝૂમે આખી રાત રે!\nગરબે ઘૂમે રૂપાળી રાધા, કાન કુંવર સંગ તાલ પુરાવે રે.",
        'plays_count' => 389000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 2. Chogada Tara Rang Chhe
    [
        'match_id' => 3,
        'title' => 'Chogada Tara Rang Chhe',
        'slug' => 'chogada-tara-rang-chhe',
        'artist_id' => $darshanId,
        'album_id' => $darshanAlbumId,
        'genre_id' => 8, // Modern Fusion
        'duration' => 275,
        'audio_url' => 'https://youtu.be/yr7JFNsz5dU',
        'youtube_id' => 'yr7JFNsz5dU',
        'cover_image' => 'https://i.ytimg.com/vi/yr7JFNsz5dU/hqdefault.jpg',
        'style' => 'Raas',
        'era' => 'Modern',
        'tradition' => 'Ahmedabad',
        'lyrics' => "છોગાળા તારા રંગ છે, રંગીલો રંગ છે...\nહે આવે રે આવે તારી યાદ રે, ધબકે છે હૈયું આજ રે!\nચોગાળા તારા છબીલા કાનુડા, ગરબે રમવા આવ ને રે.",
        'plays_count' => 890000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 3. Kamariya
    [
        'match_id' => null,
        'title' => 'Kamariya (Mitron Garba)',
        'slug' => 'kamariya-mitron-garba',
        'artist_id' => $darshanId,
        'album_id' => $darshanAlbumId,
        'genre_id' => 8, // Modern Fusion
        'duration' => 187,
        'audio_url' => 'https://youtu.be/i0_m90T04uw',
        'youtube_id' => 'i0_m90T04uw',
        'cover_image' => 'https://i.ytimg.com/vi/i0_m90T04uw/hqdefault.jpg',
        'style' => 'Fusion',
        'era' => 'Modern',
        'tradition' => 'Ahmedabad',
        'lyrics' => "હૈયે હરખ ના માય રે, રાધા નાચે કાનુડો ગાય રે...\nકમરિયા લચકે રે બાબુ કમરિયા લચકે રે!\nડીજે ના ધબકારે આખું આંગણિયું ગુંજી ઊઠે રે.",
        'plays_count' => 640000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 4. Gori Radha Ne Kalo Kaan
    [
        'match_id' => null,
        'title' => 'Gori Radha Ne Kalo Kaan',
        'slug' => 'gori-radha-ne-kalo-kaan',
        'artist_id' => 4, // Kirtidan Gadhvi
        'album_id' => 5, // Kathiyawadi Dayro & Ramzat
        'genre_id' => 2, // 3-Taali
        'duration' => 178,
        'audio_url' => 'https://youtu.be/ccqg6e2rfLU',
        'youtube_id' => 'ccqg6e2rfLU',
        'cover_image' => 'https://i.ytimg.com/vi/ccqg6e2rfLU/hqdefault.jpg',
        'style' => '3-Taali',
        'era' => 'Modern',
        'tradition' => 'Saurashtra',
        'lyrics' => "ગોરી રાધા ને કાળો કાન, ગરબે ઘૂમે ભૂલી ભાન...\nહે રાધા ના કાનુડા, ગરબે રમવા આવ ને રે!\nઝાંઝર ઝણકે પગલે પગલે તાલ મિલાવજે રે.",
        'plays_count' => 720000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 5. Pankhida Tu Udi Jaje DJ
    [
        'match_id' => null,
        'title' => 'Pankhida Tu Udi Jaje DJ',
        'slug' => 'pankhida-tu-udi-jaje-dj',
        'artist_id' => $rupalDoshiId,
        'album_id' => $rupalAlbumId,
        'genre_id' => 1, // 2-Taali
        'duration' => 126,
        'audio_url' => 'https://youtu.be/5cAISqItql8',
        'youtube_id' => '5cAISqItql8',
        'cover_image' => 'https://i.ytimg.com/vi/5cAISqItql8/hqdefault.jpg',
        'style' => '2-Taali',
        'era' => 'Modern',
        'tradition' => 'Saurashtra',
        'lyrics' => "પંખીડા તું ઊડી જાજે પાવાગઢ રે...\nમારી મહાકાળી ને જઈને કહેજે ગરબે રમે રે!\nમાડી તારા તેડું આવે તો અમે દોડ્યા આવીએ રે.",
        'plays_count' => 310000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 6. Mor Bani Thanghat Kare
    [
        'match_id' => 6,
        'title' => 'Mor Bani Thanghat Kare',
        'slug' => 'mor-bani-thanghat-kare',
        'artist_id' => 9, // Osman Mir
        'album_id' => 9, // Rangilo Raas & Sanedo Live
        'genre_id' => 4, // Hech Style
        'duration' => 212,
        'audio_url' => 'https://youtu.be/xJsvTCMg0qA',
        'youtube_id' => 'xJsvTCMg0qA',
        'cover_image' => 'https://i.ytimg.com/vi/xJsvTCMg0qA/hqdefault.jpg',
        'style' => 'Hech',
        'era' => 'Modern',
        'tradition' => 'Saurashtra',
        'lyrics' => "મન મોર બની થનગનાટ કરે...\nમેઘાડંબર ઘેરાયેલું, આભે વીજળી ચમકાર કરે!\nપ્રીતમ તારા પ્રેમ ના પગરવ અંતરમાં ગૂંજે રે.",
        'plays_count' => 590000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 7. Radha Ne Shyam Mali Jashe
    [
        'match_id' => null,
        'title' => 'Radha Ne Shyam Mali Jashe',
        'slug' => 'radha-ne-shyam-mali-jashe',
        'artist_id' => $sachinJigarId,
        'album_id' => $sachinJigarAlbumId,
        'genre_id' => 8, // Modern Fusion
        'duration' => 277,
        'audio_url' => 'https://youtu.be/tTfF5klskmo',
        'youtube_id' => 'tTfF5klskmo',
        'cover_image' => 'https://i.ytimg.com/vi/tTfF5klskmo/hqdefault.jpg',
        'style' => 'Raas',
        'era' => 'Modern',
        'tradition' => 'Ahmedabad',
        'lyrics' => "રાધા ને શ્યામ મળી જાશે તો વાત બની જાશે...\nહે તારી વાંસળી ના સૂરે મન મોહી લેશે રે!\nગરબે ઘૂમતા હૈયા ના તાર જોડાયા રે.",
        'plays_count' => 540000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 8. Naagar Nandji Na Laal
    [
        'match_id' => null,
        'title' => 'Naagar Nandji Na Laal',
        'slug' => 'naagar-nandji-na-laal',
        'artist_id' => 6, // Aditya Gadhvi
        'album_id' => 3, // Khalasi & The Heritage Waves
        'genre_id' => 4, // Hech Style
        'duration' => 315,
        'audio_url' => 'https://youtu.be/iraezTzB938',
        'youtube_id' => 'iraezTzB938',
        'cover_image' => 'https://i.ytimg.com/vi/iraezTzB938/hqdefault.jpg',
        'style' => 'Hech',
        'era' => 'Modern',
        'tradition' => 'Saurashtra',
        'lyrics' => "નાગર નંદજી ના લાલ, રાસ રમંતા મારો હાર તૂટ્યો રે...\nકાનુડા તારા રંગે રંગાણી, હે રાધા ઘેલી થઈ રે!\nમોરલી વાગે ને મનડું નાચે રે.",
        'plays_count' => 470000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 9. Vhalam Aavo Ne
    [
        'match_id' => 13,
        'title' => 'Vhalam Aavo Ne (Garba Reprise)',
        'slug' => 'vhalam-aavo-ne-garba-reprise',
        'artist_id' => 6, // Aditya Gadhvi / Jigardan
        'album_id' => 3,
        'genre_id' => 8, // Modern Fusion
        'duration' => 194,
        'audio_url' => 'https://youtu.be/5gIpqS-Qpzw',
        'youtube_id' => '5gIpqS-Qpzw',
        'cover_image' => 'https://i.ytimg.com/vi/5gIpqS-Qpzw/hqdefault.jpg',
        'style' => 'Hech',
        'era' => 'Modern',
        'tradition' => 'Ahmedabad',
        'lyrics' => "વ્હાલમ આવો ને, વ્હાલમ આવો ને...\nમંદિરમાં દીવો બળે, હૈયે હેત ના અજવાળા રે!\nપ્રીત ના તાંતણે બાંધ્યા રે અમને.",
        'plays_count' => 430000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 10. Kesariyo Rang Tane Lagyo Re
    [
        'match_id' => 14,
        'title' => 'Kesariyo Rang Tane Lagyo Re',
        'slug' => 'kesariyo-rang-tane-lagyo-re',
        'artist_id' => 4, // Kirtidan Gadhvi / DJ Chetas
        'album_id' => 5,
        'genre_id' => 2, // 3-Taali
        'duration' => 195,
        'audio_url' => 'https://youtu.be/rLsJlT-kV-I',
        'youtube_id' => 'rLsJlT-kV-I',
        'cover_image' => 'https://i.ytimg.com/vi/rLsJlT-kV-I/hqdefault.jpg',
        'style' => '3-Taali',
        'era' => 'Modern',
        'tradition' => 'Saurashtra',
        'lyrics' => "કેસરિયો રંગ તને લાગ્યો રે લોલ...\nગરબે ઘૂમતા કસુંબલ રંગે રંગાયા રે!\nઝાંઝર ની ઝણકાર બોલે, મનડું હિલોળે ચડ્યું રે.",
        'plays_count' => 510000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 11. Abhale Thi Utari Maa - Garbe Ramva Aavo
    [
        'match_id' => null,
        'title' => 'Abhale Thi Utari Maa - Garbe Ramva Aavo',
        'slug' => 'abhale-thi-utari-maa-garbe-ramva-aavo',
        'artist_id' => $hemaDesaiId,
        'album_id' => $hemaAlbumId,
        'genre_id' => 7, // Aradhiya & Stuti
        'duration' => 520,
        'audio_url' => 'https://youtu.be/CJRGtgQBxno',
        'youtube_id' => 'CJRGtgQBxno',
        'cover_image' => 'https://i.ytimg.com/vi/CJRGtgQBxno/hqdefault.jpg',
        'style' => 'Aradhiya',
        'era' => 'Traditional',
        'tradition' => 'Maa Ambe Stuti',
        'lyrics' => "આભલે થી ઊતરી માં ગરબે રમવા આવો...\nચાંદો સૂરજ સાખ પૂરે, અંબા માં ના પગલે કંકુ વરસે રે!\nહે માવડી તારી કૃપા અવિરત વરસતી રહે.",
        'plays_count' => 280000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 12. Ambe Maa Ni Aarti (Jai Adhyashakti)
    [
        'match_id' => 8,
        'title' => 'Ambe Maa Ni Aarti (Jai Adhyashakti)',
        'slug' => 'ambe-maa-ni-aarti-jai-adhyashakti',
        'artist_id' => 7, // Hemant Chauhan / Traditional
        'album_id' => 7,
        'genre_id' => 7, // Aradhiya
        'duration' => 813,
        'audio_url' => 'https://youtu.be/U_DTkSAakVQ',
        'youtube_id' => 'U_DTkSAakVQ',
        'cover_image' => 'https://i.ytimg.com/vi/U_DTkSAakVQ/hqdefault.jpg',
        'style' => 'Aradhiya',
        'era' => 'Traditional',
        'tradition' => 'Maa Ambe Stuti',
        'lyrics' => "જય આદ્યાશક્તિ મા જય આદ્યાશક્તિ...\nઅખંડ બ્રહ્માંડ દીપાવ્યા, પડવે પ્રગટ્યા મા!\nદ્વિતીયા બેય સ્વરૂપ, શિવ શક્તિ જાણો રે.",
        'plays_count' => 780000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
    // 13. Maadi Tara Mandiryama Ghantarav Vage
    [
        'match_id' => null,
        'title' => 'Maadi Tara Mandiryama Ghantarav Vage',
        'slug' => 'maadi-tara-mandiryama-ghantarav-vage',
        'artist_id' => 5, // Geeta Rabari
        'album_id' => 6, // Kutch Ni Dharti Suvarna Hits
        'genre_id' => 7, // Aradhiya
        'duration' => 434,
        'audio_url' => 'https://youtu.be/Wh-3Dk7A0vg',
        'youtube_id' => 'Wh-3Dk7A0vg',
        'cover_image' => 'https://i.ytimg.com/vi/Wh-3Dk7A0vg/hqdefault.jpg',
        'style' => 'Dakla',
        'era' => 'Modern',
        'tradition' => 'Kutch',
        'lyrics' => "માડી તારા મંદિરમાં ઘંટારવ વાગે રે...\nકંકુ ભરી થાળી લઈને અંબા તારી આરતી ઉતારું રે!\nકચ્છ ધરા ની પુણ્ય ભૂમિ પર માવડી ના ચરણો પખાળું.",
        'plays_count' => 410000,
        'is_featured' => 1,
        'is_popular' => 1
    ],
];

$allSongIds = [];

foreach ($songsToProcess as $item) {
    // Check if song already exists by youtube_id or match_id or audio_url
    $existing = null;
    if ($item['youtube_id']) {
        $existing = $db->fetch("SELECT id FROM songs WHERE youtube_id = :yt OR audio_url LIKE :url LIMIT 1", [
            'yt' => $item['youtube_id'],
            'url' => '%' . $item['youtube_id'] . '%'
        ]);
    }
    if (!$existing && $item['match_id']) {
        $existing = $db->fetch("SELECT id FROM songs WHERE id = :id LIMIT 1", ['id' => $item['match_id']]);
    }
    if (!$existing && $item['slug']) {
        $existing = $db->fetch("SELECT id FROM songs WHERE slug = :slug LIMIT 1", ['slug' => $item['slug']]);
    }

    if ($existing) {
        $songId = $existing['id'];
        $db->update('songs', [
            'title' => $item['title'],
            'slug' => $item['slug'],
            'artist_id' => $item['artist_id'],
            'album_id' => $item['album_id'],
            'genre_id' => $item['genre_id'],
            'duration' => $item['duration'],
            'audio_url' => $item['audio_url'],
            'youtube_id' => $item['youtube_id'],
            'cover_image' => $item['cover_image'],
            'style' => $item['style'],
            'era' => $item['era'],
            'tradition' => $item['tradition'],
            'lyrics' => $item['lyrics'],
            'plays_count' => $item['plays_count'],
            'is_featured' => $item['is_featured'],
            'is_popular' => $item['is_popular'],
            'updated_at' => date('Y-m-d H:i:s')
        ], 'id = :id', ['id' => $songId]);
        echo "Updated Song #{$songId}: {$item['title']} (YT: {$item['youtube_id']})\n";
    } else {
        $songId = $db->insert('songs', [
            'title' => $item['title'],
            'slug' => $item['slug'],
            'artist_id' => $item['artist_id'],
            'album_id' => $item['album_id'],
            'genre_id' => $item['genre_id'],
            'duration' => $item['duration'],
            'audio_url' => $item['audio_url'],
            'youtube_id' => $item['youtube_id'],
            'cover_image' => $item['cover_image'],
            'style' => $item['style'],
            'era' => $item['era'],
            'tradition' => $item['tradition'],
            'lyrics' => $item['lyrics'],
            'plays_count' => $item['plays_count'],
            'is_featured' => $item['is_featured'],
            'is_popular' => $item['is_popular'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        echo "Inserted New Song #{$songId}: {$item['title']} (YT: {$item['youtube_id']})\n";
    }

    $allSongIds[] = $songId;

    // Add to playlist 2 (Non-Stop 3-Taali Fire)
    $db->query("INSERT OR IGNORE INTO playlist_songs (playlist_id, song_id) VALUES (2, :sid)", ['sid' => $songId]);
    // Add to playlist 3 (My Midnight Garba Favorites)
    $db->query("INSERT OR IGNORE INTO playlist_songs (playlist_id, song_id) VALUES (3, :sid)", ['sid' => $songId]);
    // Add to user favorites
    $db->query("INSERT OR IGNORE INTO favorites (user_id, song_id) VALUES (1, :sid)", ['sid' => $songId]);
}

echo "\nSuccessfully processed all " . count($allSongIds) . " YouTube songs into database!\n";
