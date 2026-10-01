<!-- app/Views/playlists/edit.php -->
<div class="auth-page-container">
    <div class="auth-card">
        <h2>Edit Playlist</h2>
        <form action="/playlist/update" method="POST" class="auth-form">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($playlist['title'] ?? '') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Playlist</button>
        </form>
    </div>
</div>
