<!-- app/Views/auth/forgot-password.php -->
<div class="auth-page-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">Garba<span class="accent-text">26</span></div>
            <h2>Reset Password</h2>
            <p>Enter your registered email address to receive password reset instructions.</p>
        </div>

        <form action="/reset-password" method="POST" class="auth-form">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="user@garba26.com" required autofocus>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg">Send Reset Link</button>
        </form>

        <div class="auth-footer">
            Remembered your credentials? <a href="/login">Sign in here</a>
        </div>
    </div>
</div>
