<?php
// app/Views/layouts/header.php
use App\Core\Auth;
use App\Core\Session;
$currentUser = Auth::user();
$pageTitle = $title ?? 'Garba26 · Gujarati Garba music, Raas and nonstop sets';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="Gujarati Garba music, Raas, 2-Taali, 3-Taali, and nonstop sets on Garba26. Listen solo or with friends in live Garba Circles.">
    
    <!-- Google Fonts: Playfair Display, Cinzel, and Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
</head>
<body class="garba26-body">
    <!-- Toast notifications -->
    <div id="toast-container" class="toast-container">
        <?php if ($msg = Session::getFlash('success')): ?>
            <div class="toast toast-success" onclick="this.remove()">
                <span>✨ <?= htmlspecialchars($msg) ?></span>
            </div>
        <?php endif; ?>
        <?php if ($msg = Session::getFlash('error')): ?>
            <div class="toast toast-error" onclick="this.remove()">
                <span>⚠️ <?= htmlspecialchars($msg) ?></span>
            </div>
        <?php endif; ?>
    </div>
