-- Create the passwords database
CREATE DATABASE IF NOT EXISTS passwords;

-- Use the database
USE passwords;

-- Create the accounts table
CREATE TABLE accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    url VARCHAR(255),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL
);

-- Create the passwords table
CREATE TABLE passwords (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    user_id INT NOT NULL,
    password VARBINARY(255) NOT NULL,
    FOREIGN KEY (account_id) REFERENCES accounts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create the user for database access
CREATE USER 'passwords_user'@'localhost' IDENTIFIED BY 'k(D2Whiue9d8yD';
GRANT ALL PRIVILEGES ON passwords.* TO 'passwords_user'@'localhost';
FLUSH PRIVILEGES;
