<?php
// api/Songs/list.php
header('Content-Type: application/json');
require_once dirname(__DIR__, 2) . '/config/constants.php';
require_once ROOT_PATH . '/app/Core/Database.php';
require_once ROOT_PATH . '/app/Core/Model.php';
require_once ROOT_PATH . '/app/Models/Song.php';

$songs = \App\Models\Song::allWithDetails('s.is_featured DESC, s.plays_count DESC', 50);
echo json_encode(['success' => true, 'data' => $songs]);
