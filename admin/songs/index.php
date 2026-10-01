<?php
// admin/songs/index.php
use App\Models\Song;
$songs = Song::all('id DESC', 50);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Songs - Garba26 Admin</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/admin/assets/css/admin.css">
</head>
<body class="admin-layout">
    <aside class="admin-sidebar">
        <h2 style="color:#f59e0b; margin-bottom:20px;">Garba26 👑</h2>
        <a href="/admin">Dashboard</a>
        <a href="/admin/songs" style="color:#f59e0b; display:block; margin-top:10px;">Songs</a>
        <a href="/admin/artists" style="display:block; margin-top:10px;">Artists</a>
        <a href="/" style="display:block; margin-top:20px; color:#94a3b8;">← Back to App</a>
    </aside>
    <main class="admin-content">
        <div style="display:flex; justify-content:space-between; margin-bottom:24px;">
            <h1>Manage Garba Songs (<?= count($songs) ?>)</h1>
            <a href="/admin/songs/create" class="btn btn-primary">+ Add New Song</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th><th>Title</th><th>Style</th><th>Plays</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($songs as $s): ?>
                    <tr>
                        <td>#<?= $s['id'] ?></td>
                        <td><?= htmlspecialchars($s['title']) ?></td>
                        <td><?= htmlspecialchars($s['style']) ?></td>
                        <td><?= number_format($s['plays_count']) ?></td>
                        <td>
                            <a href="/admin/songs/edit?id=<?= $s['id'] ?>" style="color:#f59e0b;">Edit</a> |
                            <a href="/admin/songs/delete?id=<?= $s['id'] ?>" style="color:#e11d48;">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
