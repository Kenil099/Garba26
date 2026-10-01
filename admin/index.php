<?php
// admin/index.php
require_once dirname(__DIR__) . '/config/constants.php';
require_once ROOT_PATH . '/app/Core/Database.php';
require_once ROOT_PATH . '/app/Core/Model.php';
require_once ROOT_PATH . '/app/Core/Session.php';
require_once ROOT_PATH . '/app/Core/Auth.php';

\App\Core\Session::start();
if (!\App\Core\Auth::isAdmin()) {
    header('Location: /login');
    exit;
}

header('Location: /admin/dashboard');
exit;
