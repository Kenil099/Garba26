<!-- app/Views/circle/room.php -->
<div class="circle-room-layout" id="circle-room" data-room-code="<?= htmlspecialchars($circle['code']) ?>" data-is-host="<?= $isHost ? '1' : '0' ?>">
    <!-- Main Sync Area -->
    <div class="circle-main-stage">
        <div class="stage-header">
            <div class="room-meta">
                <span class="live-badge">🔴 LIVE SYNC</span>
                <h1 class="room-title"><?= htmlspecialchars($circle['name']) ?></h1>
                <span class="room-code-copy" onclick="navigator.clipboard.writeText('<?= htmlspecialchars($circle['code']) ?>'); GarbaToast.show('Room code copied!');" title="Click to copy code">
                    Room Code: <strong><?= htmlspecialchars($circle['code']) ?></strong> 📋
                </span>
            </div>
            <?php if ($isHost): ?>
                <span class="host-badge">👑 You are the Circle Host</span>
            <?php endif; ?>
        </div>

        <!-- Animated Center Visualizer Circle -->
        <div class="garba-rotating-ring">
            <div class="ring-track-art">
                <img src="<?= htmlspecialchars($currentSong['cover_image'] ?? '/assets/images/default-album.png') ?>" id="circle-track-art" alt="Track Art">
            </div>
            <div class="dancing-member-dots" id="member-dots">
                <!-- Avatars rendered around the circle -->
                <?php foreach ($members as $m): ?>
                    <div class="member-dot" title="<?= htmlspecialchars($m['name']) ?>">
                        <img src="<?= htmlspecialchars($m['avatar'] ?? '/assets/images/default-avatar.png') ?>" alt="Member">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="stage-track-info text-center mt-3">
            <h2 id="circle-song-title"><?= htmlspecialchars($currentSong['title'] ?? 'Select a song') ?></h2>
            <h4 id="circle-artist-name"><?= htmlspecialchars($currentSong['artist_name'] ?? 'Garba26 Audio') ?></h4>
            <div class="stage-controls">
                <button class="btn btn-primary btn-lg" onclick="GarbaCircle.triggerPlay()">
                    <span id="circle-play-state-text">Sync & Play Together</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Right: Room Chat and Member List -->
    <div class="circle-sidebar-chat">
        <div class="chat-header">
            <h3>Circle Chat (<?= count($members) ?> in room)</h3>
        </div>
        <div class="chat-messages-container" id="circle-chat-messages">
            <?php foreach ($messages as $msg): ?>
                <div class="chat-bubble">
                    <span class="chat-author"><?= htmlspecialchars($msg['user_name']) ?>:</span>
                    <span class="chat-text"><?= htmlspecialchars($msg['message']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <form class="chat-input-form" id="circle-chat-form" onsubmit="GarbaCircle.sendChat(event)">
            <input type="text" id="circle-msg-input" placeholder="Type a message or tahuko..." autocomplete="off">
            <button type="submit" class="btn btn-primary btn-sm">Send</button>
        </form>
    </div>
</div>
<script src="/assets/js/circle.js"></script>
