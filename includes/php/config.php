<?php
// Database connection configuration
$host = 'localhost'; // Database host
$db   = 'passwords'; // Database name
$user = 'passwords_user'; // Database username
$pass = 'k(D2Whiue9d8yD'; // Database password
$charset = 'utf8mb4'; // Charset for the connection

// Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options for better error handling and performance
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
];

try {
    // Attempt to create a new PDO connection
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Log the error and display a user-friendly message
    error_log("Database connection failed: " . $e->getMessage());
    die("We are experiencing technical difficulties. Please try again later.");
}
?>
