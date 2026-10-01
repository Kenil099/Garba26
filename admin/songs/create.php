<?php
// admin/songs/create.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Track - Garba26</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/auth.css">
</head>
<body style="background:#070a11; padding:40px;">
    <div class="auth-card" style="margin:0 auto;">
        <h2>Upload / Add New Garba Track</h2>
        <form action="/api/songs/create" method="POST" class="auth-form mt-3">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required placeholder="E.g. Sanedo Live 2026">
            </div>
            <div class="form-group">
                <label>Artist ID</label>
                <input type="number" name="artist_id" class="form-control" value="1" required>
            </div>
            <div class="form-group">
                <label>Style</label>
                <select name="style" class="form-control">
                    <option value="2-Taali">2-Taali</option>
                    <option value="3-Taali" selected>3-Taali</option>
                    <option value="Raas">Dandiya Raas</option>
                    <option value="Sanedo">Sanedo</option>
                    <option value="Dakla">Dakla</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Track</button>
        </form>
    </div>
</body>
</html>
