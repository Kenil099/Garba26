<!-- app/Views/auth/login.php -->
<div class="auth-page-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">Garba<span class="accent-text">26</span></div>
            <h2>Welcome Back</h2>
            <p>Sign in to your Garba26 account to access your library and Circles.</p>
        </div>

        <form action="/login" method="POST" class="auth-form" id="login-form">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="user@garba26.com" required autofocus>
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="password">Password</label>
                    <a href="/forgot-password" class="forgot-link">Forgot password?</a>
                </div>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg">Sign In</button>
        </form>

        <div class="demo-creds-box">
            <p><strong>Demo Credentials:</strong></p>
            <p>User: <code>user@garba26.com</code> / <code>garba123</code></p>
            <p>Admin: <code>admin@garba26.com</code> / <code>garba123</code></p>
        </div>

        <div class="auth-footer">
            Don't have an account? <a href="/register">Sign up for Garba26</a>
        </div>
    </div>
</div>
