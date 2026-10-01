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

// Check if youtube_id column exists in songs table, if not add it
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
        echo "Added youtube_id column to songs table.\n";
    }
} catch (Exception $e) {
    echo "Note: " . $e->getMessage() . "\n";
}

// Find artist Aditya Gadhvi
$artist = $db->fetch("SELECT id FROM artists WHERE name LIKE '%Aditya Gadhvi%' LIMIT 1");
$artistId = $artist ? $artist['id'] : 6;

// Find or set album
$album = $db->fetch("SELECT id FROM albums WHERE artist_id = :aid LIMIT 1", ['aid' => $artistId]);
$albumId = $album ? $album['id'] : 3;

// Find or set genre
$genre = $db->fetch("SELECT id FROM genres WHERE name LIKE '%Non-Stop%' OR name LIKE '%Fusion%' OR name LIKE '%3-Taali%' LIMIT 1");
$genreId = $genre ? $genre['id'] : 8;

// Check if song already exists
$existing = $db->fetch("SELECT id FROM songs WHERE youtube_id = 'MASCw3qDBsQ' OR audio_url LIKE '%MASCw3qDBsQ%' LIMIT 1");

if ($existing) {
    echo "Song already exists with ID: {$existing['id']}. Updating metadata...\n";
    $db->update('songs', [
        'title' => 'Best of Aditya Gadhvi Non stop',
        'slug' => 'best-of-aditya-gadhvi-non-stop',
        'artist_id' => $artistId,
        'album_id' => $albumId,
        'genre_id' => $genreId,
        'audio_url' => 'https://youtu.be/MASCw3qDBsQ',
        'youtube_id' => 'MASCw3qDBsQ',
        'cover_image' => 'https://i.ytimg.com/vi/MASCw3qDBsQ/hqdefault.jpg',
        'style' => 'Nonstop',
        'era' => 'Modern',
        'tradition' => 'Saurashtra',
        'is_featured' => 1,
        'is_popular' => 1,
        'plays_count' => 350000,
        'duration' => 1845,
    ], 'id = :id', ['id' => $existing['id']]);
    $songId = $existing['id'];
} else {
    $songId = $db->insert('songs', [
        'title' => 'Best of Aditya Gadhvi Non stop',
        'slug' => 'best-of-aditya-gadhvi-non-stop',
        'artist_id' => $artistId,
        'album_id' => $albumId,
        'genre_id' => $genreId,
        'duration' => 1845,
        'audio_url' => 'https://youtu.be/MASCw3qDBsQ',
        'youtube_id' => 'MASCw3qDBsQ',
        'cover_image' => 'https://i.ytimg.com/vi/MASCw3qDBsQ/hqdefault.jpg',
        'style' => 'Nonstop',
        'era' => 'Modern',
        'tradition' => 'Saurashtra',
        'lyrics' => "આદિત્ય ગઢવી ના સુર સાથે નોનસ્ટોપ ગરબા ની રમઝટ...\nહે કાનુડો માંગ્યો દે ને જશોદા મૈયા...\nમોર બની થનગનાટ કરે, રંગભીની રાધા...",
        'plays_count' => 350000,
        'is_featured' => 1,
        'is_popular' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    echo "Inserted song with ID: {$songId}.\n";
}

// Ensure it is added to a playlist (e.g. Non-Stop 3-Taali Fire playlist #2)
$db->query("INSERT OR IGNORE INTO playlist_songs (playlist_id, song_id) VALUES (2, :sid)", ['sid' => $songId]);

echo "Successfully configured 'Best of Aditya Gadhvi Non stop' [Song ID: {$songId}] with YouTube ID 'MASCw3qDBsQ'!\n";
