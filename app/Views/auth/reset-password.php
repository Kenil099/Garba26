<!-- app/Views/auth/reset-password.php -->
<div class="auth-page-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Set New Password</h2>
            <p>Choose a secure password for your Garba26 account.</p>
        </div>
        <form action="/reset-password" method="POST" class="auth-form">
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg">Update Password</button>
        </form>
    </div>
</div>
