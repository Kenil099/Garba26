<?php
// routes/api.php

use App\Controllers\SongController;
use App\Controllers\SearchController;
use App\Controllers\FavoriteController;
use App\Controllers\HistoryController;
use App\Controllers\PlaylistController;
use App\Controllers\CircleController;
use App\Controllers\NotificationController;
use App\Controllers\ShareController;

// Track player information & queue
$router->get('/api/songs', function($req, $res) { require ROOT_PATH . '/api/Songs/list.php'; });
$router->get('/api/songs/list', function($req, $res) { require ROOT_PATH . '/api/Songs/list.php'; });
$router->get('/api/song/{id}', [SongController::class, 'playInfo']);
$router->get('/api/search', [SearchController::class, 'query']);

// User actions
$router->post('/api/favorite/toggle', [FavoriteController::class, 'toggle']);
$router->post('/api/history/record', [HistoryController::class, 'record']);
$router->post('/api/playlist/add', [PlaylistController::class, 'addSong']);
$router->post('/api/playlist/remove', [PlaylistController::class, 'removeSong']);

// Circle live sync
$router->post('/api/circle/sync', [CircleController::class, 'syncState']);
$router->post('/api/circle/chat', [CircleController::class, 'postMessage']);

// Notifications & Share
$router->get('/api/notifications', [NotificationController::class, 'index']);
$router->post('/api/notifications/mark-read', [NotificationController::class, 'markRead']);
$router->get('/api/share/meta', [ShareController::class, 'getMeta']);
