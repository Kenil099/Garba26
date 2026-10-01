<?php
// tests/PlaylistTest.php
require_once dirname(__DIR__) . '/config/constants.php';
require_once ROOT_PATH . '/app/Core/Database.php';
require_once ROOT_PATH . '/app/Core/Model.php';
require_once ROOT_PATH . '/app/Models/Playlist.php';

echo "=== Running PlaylistTest ===\n";

$plId = \App\Models\Playlist::create([
    'user_id' => 1,
    'title' => 'Test Navratri Mix ' . time(),
    'is_public' => 1,
]);

assert($plId > 0, 'Playlist creation failed');
echo "✓ Created Playlist #{$plId}.\n";

$added = \App\Models\Playlist::addSong($plId, 1);
assert($added === true, 'Failed to add song to playlist');
echo "✓ Added song #1 to playlist.\n";

echo "PlaylistTest Passed Successfully! 🎶\n";
