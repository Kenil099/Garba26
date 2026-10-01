/**
 * public/assets/js/circle.js - Garba Circle Real-Time Polling & Sync
 */
const GarbaCircle = (function() {
    let syncInterval = null;
    let roomCode = '';
    let isHost = false;

    function init() {
        const room = document.getElementById('circle-room');
        if (!room) return;

        roomCode = room.getAttribute('data-room-code');
        isHost = room.getAttribute('data-is-host') === '1';

        syncInterval = setInterval(syncState, 2500);
    }

    function syncState() {
        if (!roomCode) return;
        fetch('/api/circle/sync', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({code: roomCode})
        })
        .then(r => r.json())
        .then(data => {
            if (data.success && data.circle) {
                updateUI(data);
            }
        })
        .catch(() => {});
    }

    function updateUI(data) {
        if (data.messages) {
            const container = document.getElementById('circle-chat-messages');
            if (container) {
                container.innerHTML = data.messages.map(m => `
                    <div class="chat-bubble">
                        <span class="chat-author">${m.user_name}:</span>
                        <span class="chat-text">${m.message}</span>
                    </div>
                `).join('');
            }
        }
    }

    function sendChat(e) {
        e.preventDefault();
        const input = document.getElementById('circle-msg-input');
        const msg = input.value.trim();
        if (!msg) return;

        fetch('/api/circle/chat', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({code: roomCode, message: msg})
        }).then(() => {
            input.value = '';
            syncState();
        });
    }

    function triggerPlay() {
        GarbaPlayer.playTrack(1);
        GarbaToast.show("Synchronized playback started for room!", "success");
    }

    return {
        init,
        sendChat,
        triggerPlay
    };
})();

document.addEventListener('DOMContentLoaded', GarbaCircle.init);
