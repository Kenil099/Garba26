<!-- app/Views/circle/create.php -->
<div class="auth-page-container">
    <div class="auth-card">
        <h2>Create a Garba Circle</h2>
        <p>Start a live synchronized room and share the code with friends or family.</p>
        <form action="/circle/create" method="POST" class="auth-form">
            <div class="form-group">
                <label for="name">Circle Room Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="E.g. Ahmedabad Dandiya Clan 💃" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg">Launch Circle Room</button>
        </form>
    </div>
</div>
