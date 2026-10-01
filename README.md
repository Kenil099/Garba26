# Garba26 - Premium Garba & Folk Audio Streaming Platform

![Garba26 Banner](public/assets/images/default-album.png)

> **Garba26** is a Spotify-inspired high-fidelity audio streaming platform crafted specifically for Garba, Dandiya Raas, Navratri anthems, and Gujarati folk heritage music.

---

## 🌟 Key Features

- 🎵 **Spotify-grade Audio Experience**:
  - Smooth HTML5 Audio streaming with gapless playback, seek-scrubbing, volume attenuation, shuffle, and repeat modes.
  - Built-in **Web Audio API Garba Beat Synthesizer**: Produces authentic live Dhol beats, rhythmic claps, and dandiya percussion directly in the browser even for offline or demo previews!
- 🎪 **Garba Circle (Listen Together)**:
  - Live synchronized listening rooms. Create or join with a room code.
  - Real-time room chat, synchronized play/pause/seek across all connected members.
- 🥁 **Authentic Garba Curation**:
  - **Styles**: 2-Taali (Be Taali), 3-Taali (Tran Taali), Raas Dandiya, Hech, Sanedo, Dakla, Aradhiya.
  - **Traditions**: United Way of Baroda, Maa Ambe Stuti, Kutch & Saurashtra Folk, Ahmedabad Heritage.
  - **Eras**: Vintage 90s Khelaiya, Classic Heritage, Modern Electronic Fusion.
- 🔍 **Instant Search & Filters**: Live debounce search across tracks, artists, albums, and genres.
- ❤️ **Personalized Library ("My Garba")**:
  - Favorite tracks, custom playlists with cover art, listening history, and followed artists.
- 🛡️ **Full Admin Control Suite**:
  - Dashboard analytics (plays, users, active circles, track metrics).
  - Complete CRUD for Songs, Artists, Albums, Genres, Playlists, and User moderation.
- ⚡ **Dual Database Engine**:
  - **Zero-Configuration SQLite PDO**: Ready out of the box with auto-migration and auto-seeding.
  - **Production MySQL/MariaDB Support**: Seamless toggle via `.env`.
- 📱 **Responsive Glassmorphic UI**:
  - Styled with Obsidian Dark mode, Saffron Gold (`#f59e0b`), Festival Crimson (`#e11d48`), and Emerald accents.

---

## 🚀 Quick Start Guide

### 1. Requirements
- **PHP 8.1+** with PDO SQLite or PDO MySQL enabled.

### 2. Run Built-in Web Server
Open PowerShell or your terminal in the project directory:

```bash
# Start PHP built-in server with public/ as web root
php -S localhost:8000 -t public
```

Now open your browser at:
👉 **http://localhost:8000**

---

## 🔐 Default Demo Accounts

| Role | Email | Password |
|---|---|---|
| **Admin** | `admin@garba26.com` | `garba123` |
| **User** | `user@garba26.com` | `garba123` |

Admin Dashboard: **http://localhost:8000/admin**

---

## 🗄️ Database Setup

The platform defaults to an auto-created SQLite database at `storage/database.sqlite`. It runs database schema migrations and loads rich seed data automatically on first run!

To switch to **MySQL**:
1. Edit `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=garba26
   DB_USERNAME=root
   DB_PASSWORD=
   ```
2. Import `database/schema.sql` and `database/seed.sql` into your MySQL database.

---

## 🧪 Running Tests

Run the complete test suite runner:
```bash
php tests/run_tests.php
```
Or run individual test suites:
```bash
php tests/AuthTest.php
php tests/SongTest.php
php tests/PlaylistTest.php
php tests/SearchTest.php
```

---

## 🏛️ PlayGarba Courtyard Experience
Garba26 features the **PlayGarba Courtyard UI** with:
- **Atmospheric Backgrounds**: Dynamic royal courtyard themes transitioning per genre (Folk, Traditional, Dandiya, Devotional, Sanedo, Nonstop, Fusion).
- **Floating 3D Category Dock**: Instant genre switching with 3D sculpted icons.
- **Top Utility Pill**: Quick links, instant search drawer, Private Garba Circle, liked tracks, queue, and more settings.
- **Garba Circle**: Real-time room codes to listen with friends.
- **Built-in Dhol Percussion**: Web Audio API rhythm generator.

---

© 2026 Garba26. Crafted for Navratri lovers and folk music enthusiasts worldwide.
