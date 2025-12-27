-- TomTroc SQLite schema
PRAGMA foreign_keys = ON;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    image TEXT NOT NULL ON CONFLICT REPLACE DEFAULT 'https://placehold.net/avatar.svg',
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT (datetime('now'))
);
-- Books table
CREATE TABLE IF NOT EXISTS books (
    id INTEGER PRIMARY KEY,
    user_id INTEGER NOT NULL,
    title TEXT NOT NULL,
    author TEXT,
    image TEXT NOT NULL ON CONFLICT REPLACE DEFAULT 'https://placehold.net/book.png',
    description TEXT,
    availability INTEGER NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT (datetime('now')),
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);
-- Chats table
CREATE TABLE IF NOT EXISTS chats (
    id INTEGER PRIMARY KEY,
    sender_id INTEGER NOT NULL,
    receiver_id INTEGER NOT NULL,
    message TEXT NOT NULL,
    is_read INTEGER NOT NULL DEFAULT 0,
    sent_at DATETIME NOT NULL DEFAULT (datetime('now')),
    FOREIGN KEY(sender_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY(receiver_id) REFERENCES users(id) ON DELETE CASCADE
);
-- indexes
CREATE INDEX IF NOT EXISTS idx_chats_sender_receiver ON chats(sender_id, receiver_id);
CREATE INDEX IF NOT EXISTS idx_books_availability ON books(availability);