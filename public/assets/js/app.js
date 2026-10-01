/**
 * public/assets/js/app.js - Global Interactions
 */
document.addEventListener('DOMContentLoaded', () => {
    // Sidebar Mobile Toggle
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('app-sidebar');
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('mobile-open');
        });
    }

    // User Profile Dropdown
    const userBtn = document.getElementById('user-menu-btn');
    const userDropdown = document.getElementById('user-dropdown');
    if (userBtn && userDropdown) {
        userBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('active');
        });
    }

    // Close Dropdowns on Click Outside
    document.addEventListener('click', () => {
        if (userDropdown) userDropdown.classList.remove('active');
        const notifDropdown = document.getElementById('notif-dropdown');
        if (notifDropdown) notifDropdown.classList.remove('active');
    });
});

// Toast notification helper
const GarbaToast = {
    show: function(msg, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return;
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.innerHTML = `<span class="toast-icon">${type === 'success' ? '✨' : '⚠️'}</span><span>${msg}</span>`;
        toast.onclick = () => toast.remove();
        container.appendChild(toast);
        setTimeout(() => toast.remove(), 4000);
    }
};
