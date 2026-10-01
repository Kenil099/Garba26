<!-- app/Views/profile/security.php -->
<div class="profile-security-page">
    <div class="auth-card">
        <h2>Security & Privacy</h2>
        <form action="/profile/update-password" method="POST" class="auth-form">
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" class="form-control" placeholder="••••••••">
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control" placeholder="••••••••">
            </div>
            <button type="button" class="btn btn-primary" onclick="alert('Password updated in demo mode!')">Update Password</button>
        </form>
    </div>
</div>
