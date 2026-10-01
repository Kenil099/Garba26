<?php
// tests/SongTest.php
require_once dirname(__DIR__) . '/config/constants.php';
require_once ROOT_PATH . '/app/Core/Database.php';
require_once ROOT_PATH . '/app/Core/Model.php';
require_once ROOT_PATH . '/app/Models/Song.php';

echo "=== Running SongTest ===\n";

// 1. Fetch featured
$featured = \App\Models\Song::getFeatured(5);
assert(count($featured) > 0, 'Featured songs query returned empty');
echo "✓ Fetched " . count($featured) . " featured songs.\n";

// 2. Fetch with details
$song = \App\Models\Song::findWithDetails(1);
assert($song !== null, 'Song #1 not found');
assert(!empty($song['artist_name']), 'Artist relation missing on song details');
echo "✓ Song details relation passed.\n";

echo "SongTest Passed Successfully! 🎵\n";
