<?php
// api/Auth/register.php
header('Content-Type: application/json');
require_once dirname(__DIR__, 2) . '/config/constants.php';
require_once ROOT_PATH . '/app/Core/Database.php';
require_once ROOT_PATH . '/app/Core/Model.php';
require_once ROOT_PATH . '/app/Models/User.php';
require_once ROOT_PATH . '/app/Core/Auth.php';
require_once ROOT_PATH . '/app/Services/AuthService.php';

$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$service = new \App\Services\AuthService();
$result = $service->register($input);

echo json_encode($result);
