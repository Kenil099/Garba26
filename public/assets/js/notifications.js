/**
 * public/assets/js/notifications.js
 */
document.addEventListener('DOMContentLoaded', () => {
    const notifBtn = document.getElementById('notif-btn');
    const dropdown = document.getElementById('notif-dropdown');
    if (!notifBtn || !dropdown) return;

    notifBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('active');
        fetchNotifications();
    });

    function fetchNotifications() {
        fetch('/api/notifications')
            .then(r => r.json())
            .then(data => {
                const list = document.getElementById('notif-list');
                if (data.notifications && data.notifications.length > 0) {
                    list.innerHTML = data.notifications.map(n => `
                        <div style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.06);">
                            <strong style="display:block; font-size:0.85rem; color:#fff;">${n.title}</strong>
                            <span style="font-size:0.78rem; color:#94a3b8;">${n.message}</span>
                        </div>
                    `).join('');
                }
            });
    }
});
