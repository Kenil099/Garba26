<?php
// api/Auth/profile.php
header('Content-Type: application/json');
require_once dirname(__DIR__, 2) . '/config/constants.php';
require_once ROOT_PATH . '/app/Core/Session.php';
require_once ROOT_PATH . '/app/Core/Auth.php';

$user = \App\Core\Auth::user();
echo json_encode(['success' => (bool)$user, 'user' => $user]);
