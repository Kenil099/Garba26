<?php
// api/Auth/logout.php
header('Content-Type: application/json');
require_once dirname(__DIR__, 2) . '/config/constants.php';
require_once ROOT_PATH . '/app/Core/Session.php';
require_once ROOT_PATH . '/app/Core/Auth.php';

\App\Core\Auth::logout();
echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
