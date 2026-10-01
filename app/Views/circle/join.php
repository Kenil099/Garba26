<!-- app/Views/circle/join.php -->
<div class="auth-page-container">
    <div class="auth-card">
        <h2>Join Garba Circle</h2>
        <form action="/circle/join" method="GET" class="auth-form">
            <div class="form-group">
                <label for="code">Circle Room Code</label>
                <input type="text" id="code" name="code" class="form-control" placeholder="E.g. BARODA26" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg">Enter Room</button>
        </form>
    </div>
</div>
