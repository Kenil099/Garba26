<?php
// config/app.php

return [
    'name' => 'Garba26',
    'tagline' => 'Feel the Rhythm of Navratri & Heritage Garba',
    'env' => getenv('APP_ENV') ?: 'development',
    'debug' => (bool)(getenv('APP_DEBUG') ?: true),
    'url' => getenv('APP_URL') ?: 'http://localhost:8000',
    'timezone' => 'Asia/Kolkata',
    'locale' => 'en',
    
    // Core directory paths
    'paths' => [
        'root'     => dirname(__DIR__),
        'app'      => dirname(__DIR__) . '/app',
        'public'   => dirname(__DIR__) . '/public',
        'storage'  => dirname(__DIR__) . '/storage',
        'views'    => dirname(__DIR__) . '/app/Views',
        'uploads'  => dirname(__DIR__) . '/public/uploads',
    ],
    
    // Upload settings
    'uploads' => [
        'max_size' => 25 * 1024 * 1024, // 25MB
        'allowed_audio' => ['mp3', 'wav', 'ogg', 'm4a', 'aac'],
        'allowed_images' => ['jpg', 'jpeg', 'png', 'webp', 'svg'],
    ],
];
