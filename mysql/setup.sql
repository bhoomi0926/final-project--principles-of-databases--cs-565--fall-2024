-- Drop existing tables if they exist
DROP TABLE IF EXISTS passwords, users, accounts;

-- Drop the user if it exists
DROP USER IF EXISTS 'passwords_user'@'localhost';

-- Create the passwords database
CREATE DATABASE IF NOT EXISTS passwords;

-- Use the database
USE passwords;

-- Create the accounts table
CREATE TABLE IF NOT EXISTS accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    url VARCHAR(255),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL
);

-- Create the passwords table
CREATE TABLE IF NOT EXISTS passwords (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    user_id INT NOT NULL,
    password VARBINARY(255) NOT NULL,
    FOREIGN KEY (account_id) REFERENCES accounts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create the user for database access
CREATE USER IF NOT EXISTS 'passwords_user'@'localhost' IDENTIFIED BY 'k(D2Whiue9d8yD';

-- Grant privileges on the passwords database to the user
GRANT ALL PRIVILEGES ON passwords.* TO 'passwords_user'@'localhost';

-- Apply privileges
FLUSH PRIVILEGES;

-- Insert sample accounts
INSERT INTO accounts (name, url, comment) VALUES
    ('Gmail', 'https://mail.google.com', 'Personal email'),
    ('Facebook', 'https://facebook.com', 'Social media account'),
    ('LinkedIn', 'https://linkedin.com', 'Professional networking site'),
    ('Twitter', 'https://twitter.com', 'Social media for updates'),
    ('Amazon', 'https://amazon.com', 'Shopping account'),
    ('Netflix', 'https://netflix.com', 'Streaming platform'),
    ('Spotify', 'https://spotify.com', 'Music streaming'),
    ('GitHub', 'https://github.com', 'Version control'),
    ('Zoom', 'https://zoom.us', 'Video conferencing app'),
    ('Reddit', 'https://reddit.com', 'Forum for discussions');

-- Insert sample users (ensure unique emails)
INSERT INTO users (first_name, last_name, email, username) VALUES
    ('John', 'Doe', 'john.doe@gmail.com', 'johndoe'),
    ('Jane', 'Smith', 'jane.smith@yahoo.com', 'janesmith'),
    ('Bob', 'Johnson', 'bob.j@gmail.com', 'bobjohnson');

-- Insert sample passwords (AES_ENCRYPTed passwords)
INSERT INTO passwords (account_id, user_id, password) VALUES
    (1, 1, AES_ENCRYPT('GmailPassword123', 'encryption_key')),
    (2, 1, AES_ENCRYPT('FacebookPass456', 'encryption_key')),
    (3, 2, AES_ENCRYPT('LinkedInSecure!', 'encryption_key')),
    (4, 2, AES_ENCRYPT('Twitter123', 'encryption_key')),
    (5, 1, AES_ENCRYPT('Amazon2023', 'encryption_key')),
    (6, 3, AES_ENCRYPT('NetflixStream!', 'encryption_key')),
    (7, 3, AES_ENCRYPT('SpotifyRocks', 'encryption_key')),
    (8, 1, AES_ENCRYPT('GitHubCode#1', 'encryption_key')),
    (9, 2, AES_ENCRYPT('Zoom4Meet', 'encryption_key')),
    (10, 3, AES_ENCRYPT('RedditPass99', 'encryption_key'));
