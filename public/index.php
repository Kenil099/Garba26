<?php
// public/index.php - Front Controller for Garba26

// Set execution limits and error reporting based on environment
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Root path configuration
define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/config/constants.php';

// PSR-4 Autoloader for App namespace
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = ROOT_PATH . '/app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Initialize session
use App\Core\Session;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;

Session::start();

// Handle direct static file requests if using built-in PHP server
if (php_sapi_name() === 'cli-server') {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $fullPath = __DIR__ . $uri;
    if ($uri !== '/' && file_exists($fullPath) && !is_dir($fullPath)) {
        return false;
    }
}

// Instantiate request, response and router
$request = new Request();
$response = new Response();
$router = new Router($request, $response);

// Register routes
require ROOT_PATH . '/routes/web.php';
require ROOT_PATH . '/routes/api.php';
require ROOT_PATH . '/routes/admin.php';

// Resolve incoming request
$router->resolve();
