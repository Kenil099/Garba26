<?php
// admin/dashboard/index.php
use App\Models\Song;
use App\Models\Artist;
use App\Models\User;
use App\Models\Circle;

$totalSongs = Song::count();
$totalArtists = Artist::count();
$totalUsers = User::count();
$totalCircles = Circle::count();
$recentSongs = Song::all('id DESC', 6);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Garba26 Admin Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/admin/assets/css/admin.css">
</head>
<body class="admin-layout">
    <aside class="admin-sidebar">
        <h2 style="color:#f59e0b; font-family:'Outfit'; margin-bottom:24px;">Garba26 👑</h2>
        <ul class="nav-links">
            <li class="active"><a href="/admin">Dashboard</a></li>
            <li><a href="/admin/songs">Manage Songs</a></li>
            <li><a href="/admin/artists">Manage Artists</a></li>
            <li><a href="/admin/albums">Manage Albums</a></li>
            <li><a href="/admin/genres">Genres & Styles</a></li>
            <li><a href="/admin/users">Users & Moderation</a></li>
            <li><a href="/admin/circles">Active Circles</a></li>
            <li><a href="/admin/analytics">Analytics</a></li>
            <li style="margin-top:20px;"><a href="/" style="color:#94a3b8;">← Back to App</a></li>
        </ul>
    </aside>

    <main class="admin-content">
        <h1 style="margin-bottom:24px;">Garba26 Operations Dashboard</h1>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Garba Tracks</h3>
                <div class="stat-value"><?= $totalSongs ?></div>
            </div>
            <div class="stat-card">
                <h3>Registered Maestros</h3>
                <div class="stat-value"><?= $totalArtists ?></div>
            </div>
            <div class="stat-card">
                <h3>Active Dancers (Users)</h3>
                <div class="stat-value"><?= $totalUsers ?></div>
            </div>
            <div class="stat-card">
                <h3>Live Garba Circles</h3>
                <div class="stat-value"><?= $totalCircles ?></div>
            </div>
        </div>

        <div class="section-block">
            <div class="section-header">
                <h2>Recently Added Tracks</h2>
                <a href="/admin/songs/create" class="btn btn-primary btn-sm">+ Add New Song</a>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Style</th>
                        <th>Plays</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentSongs as $s): ?>
                        <tr>
                            <td>#<?= $s['id'] ?></td>
                            <td><strong><?= htmlspecialchars($s['title']) ?></strong></td>
                            <td><span class="badge-tag"><?= htmlspecialchars($s['style']) ?></span></td>
                            <td><?= number_format($s['plays_count']) ?></td>
                            <td>
                                <a href="/admin/songs/edit?id=<?= $s['id'] ?>" style="color:#f59e0b; margin-right:12px;">Edit</a>
                                <a href="/admin/songs/delete?id=<?= $s['id'] ?>" style="color:#e11d48;" onclick="return confirm('Delete track?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
