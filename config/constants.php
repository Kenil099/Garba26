<?php
// config/constants.php

defined('SITE_NAME') or define('SITE_NAME', 'Garba26');
defined('APP_VERSION') or define('APP_VERSION', '1.0.0');
defined('ROOT_PATH') or define('ROOT_PATH', dirname(__DIR__));
defined('PUBLIC_PATH') or define('PUBLIC_PATH', ROOT_PATH . '/public');
defined('STORAGE_PATH') or define('STORAGE_PATH', ROOT_PATH . '/storage');
defined('VIEWS_PATH') or define('VIEWS_PATH', ROOT_PATH . '/app/Views');

// User roles
defined('ROLE_USER') or define('ROLE_USER', 'user');
defined('ROLE_ADMIN') or define('ROLE_ADMIN', 'admin');

// Garba categories & styles
defined('STYLES') or define('STYLES', [
    '2-Taali'     => '2-Taali (Be Taali)',
    '3-Taali'     => '3-Taali (Tran Taali)',
    'Raas'        => 'Dandiya Raas',
    'Hech'        => 'Hech Style Garba',
    'Sanedo'      => 'Sanedo & Traditional Call-and-Response',
    'Dakla'       => 'Dakla & Fast Trance Beats',
    'Aradhiya'    => 'Aradhiya & Stuti Vandana',
    'Fusion'      => 'Modern Fusion & Electro Garba',
]);

defined('TRADITIONS') or define('TRADITIONS', [
    'United Way'    => 'United Way of Baroda Classic',
    'Maa Ambe Stuti'=> 'Maa Ambe Stuti & Sacred Aarti',
    'Saurashtra'    => 'Kathiyawadi & Saurashtra Folk',
    'Kutch'         => 'Kutchi Dhol & Flute Melodies',
    'Ahmedabad'     => 'Ahmedabad Club & Heritage Style',
]);

defined('ERAS') or define('ERAS', [
    'Traditional' => 'Ancient Folk & Authentic Roots',
    'Vintage 90s' => '90s Golden Era (Khelaiya & Dandiya Night)',
    'Modern'      => 'Contemporary 2026 Hits & Viral Fusion',
]);

// Register PSR-4 Autoloader for App namespace
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
        require_once $file;
    }
});

