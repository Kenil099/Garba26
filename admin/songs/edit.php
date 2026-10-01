<?php
// admin/songs/edit.php
$id = (int)($_GET['id'] ?? 0);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Track #<?= $id ?></title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/auth.css">
</head>
<body style="background:#070a11; padding:40px;">
    <div class="auth-card" style="margin:0 auto;">
        <h2>Edit Garba Track #<?= $id ?></h2>
        <form action="/api/songs/update" method="POST" class="auth-form mt-3">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="form-group">
                <label>Track Title</label>
                <input type="text" name="title" class="form-control" value="Edited Garba Track">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update Track</button>
        </form>
    </div>
</body>
</html>
