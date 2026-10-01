<?php
// api/Songs/get.php
header('Content-Type: application/json');
require_once dirname(__DIR__, 2) . '/config/constants.php';
require_once ROOT_PATH . '/app/Core/Database.php';
require_once ROOT_PATH . '/app/Core/Model.php';
require_once ROOT_PATH . '/app/Models/Song.php';

$id = (int)($_GET['id'] ?? 0);
$song = \App\Models\Song::findWithDetails($id);
echo json_encode(['success' => (bool)$song, 'data' => $song]);
