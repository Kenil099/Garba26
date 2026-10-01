<!-- app/Views/circle/index.php -->
<div class="circle-landing-page">
    <div class="circle-hero">
        <div class="circle-graphic-spin">
            <div class="circle-ring-inner">
                <span class="dancer-emoji">💃</span>
                <span class="dancer-emoji">🕺</span>
                <span class="dancer-emoji">🥁</span>
                <span class="dancer-emoji">✨</span>
            </div>
        </div>
        <h1 class="circle-title">Garba <span class="accent-text">Circle</span></h1>
        <p class="circle-desc">
            Sync up with friends or thousands of Garba lovers worldwide! The host controls play, pause, and seek, while everyone in the Circle dances to the exact same beat at the exact same millisecond.
        </p>

        <div class="circle-actions">
            <a href="/circle/create" class="btn btn-primary btn-lg">+ Create a New Circle</a>
            <div class="join-by-code-box">
                <form action="/circle/join" method="GET" class="join-form">
                    <input type="text" name="code" placeholder="Enter Room Code (e.g. BARODA26)" class="form-control" required>
                    <button type="submit" class="btn btn-secondary">Join Room</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Active Public Circles -->
    <div class="section-block mt-4">
        <h2 class="section-title">Active Public Garba Circles</h2>
        <div class="circles-grid">
            <?php foreach ($circles as $circ): ?>
                <div class="circle-card">
                    <div class="circle-card-header">
                        <span class="live-dot-green"></span>
                        <span class="room-code-tag">CODE: <?= htmlspecialchars($circ['code']) ?></span>
                    </div>
                    <h3 class="circle-room-name"><?= htmlspecialchars($circ['name']) ?></h3>
                    <p class="circle-room-info">Synchronized Navratri Room</p>
                    <a href="/circle/room/<?= htmlspecialchars($circ['code']) ?>" class="btn btn-outline btn-block mt-2">
                        Enter Room 🎧
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
