<!-- app/Views/profile/index.php -->
<div class="profile-page-container">
    <div class="profile-card-header">
        <img src="<?= htmlspecialchars($user['avatar'] ?? '/assets/images/default-avatar.png') ?>" alt="Avatar" class="profile-avatar-lg">
        <div class="profile-meta">
            <h1><?= htmlspecialchars($user['name']) ?></h1>
            <p><?= htmlspecialchars($user['email']) ?></p>
            <p class="profile-bio"><?= htmlspecialchars($user['bio'] ?? 'Garba26 Enthusiast') ?></p>
            <div class="profile-actions">
                <a href="/profile/edit" class="btn btn-outline">Edit Profile</a>
                <a href="/profile/settings" class="btn btn-outline">Settings</a>
            </div>
        </div>
    </div>
</div>
