<?php
// app/Views/layouts/navbar.php
use App\Core\Auth;
use App\Models\Notification;
$user = Auth::user();
$unreadNotifications = $user ? Notification::getUnreadCount($user['id']) : 0;
?>
<header class="top-navbar">
    <div class="nav-left">
        <button class="mobile-toggle-btn" id="sidebar-toggle" aria-label="Toggle navigation">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
        </button>
        <div class="nav-history-buttons">
            <button class="nav-round-btn" onclick="history.back()" title="Back">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            <button class="nav-round-btn" onclick="history.forward()" title="Forward">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
        </div>
        <div class="search-bar-wrap">
            <form action="/search" method="GET" class="search-form" id="global-search-form">
                <img src="/assets/icons/search.svg" class="search-icon" alt="Search">
                <input type="text" name="q" id="search-input" placeholder="Search Garba songs, artists, 3-Taali, Atul Purohit..." autocomplete="off">
            </form>
            <div class="search-dropdown" id="search-results-dropdown"></div>
        </div>
    </div>

    <div class="nav-right">
        <!-- Live Circle Room Status Pill -->
        <a href="/circle" class="circle-status-pill" title="Listen Together in Real-time">
            <span class="live-dot"></span>
            <span class="pill-label">Garba Circle</span>
        </a>

        <?php if ($user): ?>
            <!-- Notification Bell -->
            <div class="nav-item-dropdown">
                <button class="notification-bell-btn" id="notif-btn" aria-label="Notifications">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    <?php if ($unreadNotifications > 0): ?>
                        <span class="notif-badge"><?= $unreadNotifications ?></span>
                    <?php endif; ?>
                </button>
                <div class="dropdown-menu notif-menu" id="notif-dropdown">
                    <div class="dropdown-header">
                        <h4>Notifications</h4>
                        <button class="text-btn" id="mark-all-read">Mark all read</button>
                    </div>
                    <div class="notif-list" id="notif-list">
                        <div class="notif-empty">No new notifications</div>
                    </div>
                </div>
            </div>

            <!-- User Avatar & Dropdown -->
            <div class="nav-item-dropdown">
                <button class="user-avatar-btn" id="user-menu-btn">
                    <img src="<?= htmlspecialchars($user['avatar'] ?? '/assets/images/default-avatar.png') ?>" alt="<?= htmlspecialchars($user['name']) ?>" class="avatar-img">
                    <span class="user-display-name"><?= htmlspecialchars(explode(' ', $user['name'])[0]) ?></span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="dropdown-menu user-menu" id="user-dropdown">
                    <div class="user-menu-header">
                        <strong><?= htmlspecialchars($user['name']) ?></strong>
                        <small><?= htmlspecialchars($user['email']) ?></small>
                    </div>
                    <div class="menu-divider"></div>
                    <a href="/profile" class="dropdown-link">My Profile</a>
                    <a href="/my-garba/favorites" class="dropdown-link">Favorites</a>
                    <a href="/playlists" class="dropdown-link">Playlists</a>
                    <a href="/profile/settings" class="dropdown-link">Settings</a>
                    <?php if (Auth::isAdmin()): ?>
                        <a href="/admin" class="dropdown-link text-warning">Admin Dashboard 👑</a>
                    <?php endif; ?>
                    <div class="menu-divider"></div>
                    <a href="/logout" class="dropdown-link text-danger">Sign Out</a>
                </div>
            </div>
        <?php else: ?>
            <div class="auth-buttons">
                <a href="/login" class="btn btn-outline">Sign In</a>
                <a href="/register" class="btn btn-primary">Join Free</a>
            </div>
        <?php endif; ?>
    </div>
</header>
