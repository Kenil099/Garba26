<?php
// app/Views/layouts/sidebar.php
use App\Core\Auth;
$isLoggedIn = Auth::check();
$currentUri = $_SERVER['REQUEST_URI'] ?? '/';
?>
<aside class="app-sidebar" id="app-sidebar">
    <!-- Brand Logo -->
    <div class="sidebar-brand">
        <a href="/" class="brand-link">
            <div class="brand-icon-wrapper">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="m10 8 6 4-6 4V8z"/>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                </svg>
            </div>
            <div class="brand-text">
                <span class="brand-title">Garba<span class="accent-text">26</span></span>
                <span class="brand-subtitle">Dandiya & Folk Stream</span>
            </div>
        </a>
    </div>

    <!-- Navigation Section -->
    <div class="sidebar-scrollable">
        <div class="nav-group">
            <span class="nav-group-title">DISCOVER</span>
            <ul class="nav-links">
                <li class="<?= $currentUri === '/' ? 'active' : '' ?>">
                    <a href="/">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Home</span>
                    </a>
                </li>
                <li class="<?= str_starts_with($currentUri, '/explore') ? 'active' : '' ?>">
                    <a href="/explore">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                        <span>Explore</span>
                    </a>
                </li>
                <li class="<?= str_starts_with($currentUri, '/search') ? 'active' : '' ?>">
                    <a href="/search">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <span>Search</span>
                    </a>
                </li>
                <li class="<?= str_starts_with($currentUri, '/circle') ? 'active' : '' ?>">
                    <a href="/circle" class="special-circle-nav">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"></circle><path d="M10 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        <span>Garba Circle</span>
                        <span class="badge-hot">LIVE</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav-group">
            <span class="nav-group-title">GARBA HERITAGE</span>
            <ul class="nav-links">
                <li><a href="/explore/styles?style=2-Taali"><span>2-Taali (Be Taali)</span></a></li>
                <li><a href="/explore/styles?style=3-Taali"><span>3-Taali (Tran Taali)</span></a></li>
                <li><a href="/explore/styles?style=Raas"><span>Dandiya Raas</span></a></li>
                <li><a href="/explore/styles?style=Sanedo"><span>Sanedo Ramzat</span></a></li>
                <li><a href="/explore/styles?style=Dakla"><span>Dakla Trance</span></a></li>
                <li><a href="/explore/traditions?tradition=United+Way"><span>United Way Baroda</span></a></li>
            </ul>
        </div>

        <div class="nav-group">
            <span class="nav-group-title">MY LIBRARY</span>
            <ul class="nav-links">
                <li class="<?= str_starts_with($currentUri, '/my-garba/favorites') ? 'active' : '' ?>">
                    <a href="/my-garba/favorites">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                        <span>Liked Songs</span>
                    </a>
                </li>
                <li class="<?= str_starts_with($currentUri, '/playlists') ? 'active' : '' ?>">
                    <a href="/playlists">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"></path><circle cx="6" cy="18" r="3"></circle><circle cx="18" cy="16" r="3"></circle></svg>
                        <span>Playlists</span>
                    </a>
                </li>
                <li class="<?= str_starts_with($currentUri, '/my-garba/history') ? 'active' : '' ?>">
                    <a href="/my-garba/history">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <span>Recently Played</span>
                    </a>
                </li>
                <li>
                    <a href="/artists">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span>Artists</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Quick Action / Create Playlist Button -->
    <div class="sidebar-footer">
        <a href="/playlists/create" class="btn btn-secondary btn-full">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Create Playlist</span>
        </a>
    </div>
</aside>
