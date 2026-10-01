CREATE TABLE IF NOT EXISTS genres (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT NULL,
    image VARCHAR(255) DEFAULT '/assets/images/default-album.png',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
