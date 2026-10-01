<?php
// tests/AuthTest.php
require_once dirname(__DIR__) . '/config/constants.php';
require_once ROOT_PATH . '/app/Core/Database.php';
require_once ROOT_PATH . '/app/Core/Model.php';
require_once ROOT_PATH . '/app/Models/User.php';
require_once ROOT_PATH . '/app/Core/Auth.php';
require_once ROOT_PATH . '/app/Services/AuthService.php';

echo "=== Running AuthTest ===\n";

$authService = new \App\Services\AuthService();
$testEmail = 'tester_' . time() . '@garba26.com';

// 1. Register test
$regResult = $authService->register([
    'name' => 'Garba Tester',
    'email' => $testEmail,
    'password' => 'secret123',
]);

assert($regResult['success'] === true, 'User registration failed!');
echo "✓ Registration passed.\n";

// 2. Login test
$loginResult = $authService->login($testEmail, 'secret123');
assert($loginResult['success'] === true, 'User login failed!');
echo "✓ Login passed.\n";

echo "AuthTest Passed Successfully! ✨\n";
