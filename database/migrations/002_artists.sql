CREATE TABLE IF NOT EXISTS artists (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    image VARCHAR(255) DEFAULT '/assets/images/default-avatar.png',
    banner VARCHAR(255) DEFAULT '/assets/images/default-album.png',
    bio TEXT NULL,
    genres VARCHAR(255) NULL,
    monthly_listeners INTEGER DEFAULT 0,
    is_verified INTEGER DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
