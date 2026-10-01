<?php
// api/Songs/create.php
header('Content-Type: application/json');
require_once dirname(__DIR__, 2) . '/config/constants.php';
require_once ROOT_PATH . '/app/Core/Database.php';
require_once ROOT_PATH . '/app/Core/Model.php';
require_once ROOT_PATH . '/app/Models/Song.php';
require_once ROOT_PATH . '/app/Core/Session.php';
require_once ROOT_PATH . '/app/Core/Auth.php';

if (!\App\Core\Auth::isAdmin()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Admin authorization required.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$songId = \App\Models\Song::create([
    'title'       => $input['title'],
    'slug'        => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $input['title']))),
    'artist_id'   => $input['artist_id'],
    'album_id'    => $input['album_id'] ?? null,
    'genre_id'    => $input['genre_id'] ?? null,
    'style'       => $input['style'] ?? '3-Taali',
    'lyrics'      => $input['lyrics'] ?? '',
    'audio_url'   => $input['audio_url'] ?? '',
    'cover_image' => $input['cover_image'] ?? '/assets/images/default-album.png',
]);

echo json_encode(['success' => true, 'id' => $songId]);
