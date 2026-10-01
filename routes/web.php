<?php
// routes/web.php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\SearchController;
use App\Controllers\SongController;
use App\Controllers\ArtistController;
use App\Controllers\AlbumController;
use App\Controllers\GenreController;
use App\Controllers\ExploreController;
use App\Controllers\PlaylistController;
use App\Controllers\FavoriteController;
use App\Controllers\HistoryController;
use App\Controllers\CircleController;

// Main navigation
$router->get('/', [HomeController::class, 'index']);
$router->get('/explore', [ExploreController::class, 'index']);
$router->get('/explore/styles', [ExploreController::class, 'styles']);
$router->get('/explore/traditions', [ExploreController::class, 'traditions']);
$router->get('/explore/eras', [ExploreController::class, 'eras']);
$router->get('/explore/catalogue', [ExploreController::class, 'catalogue']);
$router->get('/search', [SearchController::class, 'index']);

// Authentication routes
$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'showRegister']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/logout', [AuthController::class, 'logout']);
$router->get('/forgot-password', [AuthController::class, 'showForgotPassword']);
$router->post('/reset-password', [AuthController::class, 'resetPassword']);
$router->get('/verify-email', [AuthController::class, 'verifyEmail']);

// Songs & Media
$router->get('/songs', [SongController::class, 'index']);
$router->get('/song/{id}', [SongController::class, 'details']);

// Artists & Albums
$router->get('/artists', [ArtistController::class, 'index']);
$router->get('/artist/{slug}', [ArtistController::class, 'details']);
$router->get('/albums', [AlbumController::class, 'index']);
$router->get('/album/{slug}', [AlbumController::class, 'details']);

// Genres
$router->get('/genres', [GenreController::class, 'index']);
$router->get('/genre/{slug}', [GenreController::class, 'details']);

// Playlists
$router->get('/playlists', [PlaylistController::class, 'index']);
$router->get('/playlists/create', [PlaylistController::class, 'create']);
$router->post('/playlists/create', [PlaylistController::class, 'store']);
$router->get('/playlist/{id}', [PlaylistController::class, 'details']);

// My Garba (Library)
$router->get('/my-garba', [FavoriteController::class, 'index']);
$router->get('/my-garba/favorites', [FavoriteController::class, 'index']);
$router->get('/my-garba/history', [HistoryController::class, 'index']);

// User Profile
$router->get('/profile', [UserController::class, 'profile']);
$router->get('/profile/edit', [UserController::class, 'edit']);
$router->post('/profile/update', [UserController::class, 'update']);
$router->get('/profile/settings', [UserController::class, 'settings']);
$router->get('/profile/security', [UserController::class, 'security']);

// Garba Circle (Listening Rooms)
$router->get('/circle', [CircleController::class, 'index']);
$router->get('/circle/create', [CircleController::class, 'create']);
$router->post('/circle/create', [CircleController::class, 'store']);
$router->get('/circle/join', [CircleController::class, 'join']);
$router->get('/circle/room/{code}', [CircleController::class, 'room']);
