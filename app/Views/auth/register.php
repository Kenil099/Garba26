<!-- app/Views/auth/register.php -->
<div class="auth-page-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">Garba<span class="accent-text">26</span></div>
            <h2>Join Garba26 Free</h2>
            <p>Create your profile, curate your Navratri playlists, and join live listening Circles.</p>
        </div>

        <form action="/register" method="POST" class="auth-form" id="register-form">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Kinjal Patel" required autofocus>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="kinjal@example.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password (min. 6 characters)</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg">Create Free Account</button>
        </form>

        <div class="auth-footer">
            Already have an account? <a href="/login">Sign in</a>
        </div>
    </div>
</div>
