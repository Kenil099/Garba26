<!-- app/Views/profile/edit.php -->
<div class="auth-page-container">
    <div class="auth-card">
        <h2>Edit Your Profile</h2>
        <form action="/profile/update" method="POST" class="auth-form">
            <div class="form-group">
                <label for="name">Display Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea id="bio" name="bio" class="form-control" rows="3"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
        </form>
    </div>
</div>
