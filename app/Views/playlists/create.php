<!-- app/Views/playlists/create.php -->
<div class="auth-page-container">
    <div class="auth-card">
        <h2>Create a New Playlist</h2>
        <p>Give your Garba mix a festive name.</p>
        <form action="/playlists/create" method="POST" class="auth-form">
            <div class="form-group">
                <label for="title">Playlist Name</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="E.g. Baroda Night 1 Non-Stop" required autofocus>
            </div>
            <div class="form-group">
                <label for="description">Description (optional)</label>
                <textarea id="description" name="description" class="form-control" rows="3" placeholder="My favorite 3-taali and hech tracks for Navratri..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg">Create Playlist</button>
        </form>
    </div>
</div>
