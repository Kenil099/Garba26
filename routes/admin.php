<?php
// routes/admin.php

// Admin routes handled directly by the /admin controller or route mappings
$router->get('/admin', function($request, $response) {
    if (!\App\Core\Auth::isAdmin()) {
        $response->redirect('/login');
    }
    require ROOT_PATH . '/admin/dashboard/index.php';
});
