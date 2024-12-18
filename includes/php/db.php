<?php
// db.php

// Define database connection parameters
$host = 'localhost';
$dbname = 'passwords';
$username = 'passwords_user';
$password = 'k(D2Whiue9d8yD';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

/**
 * Fetch all usernames from the users table.
 *
 * @return array Array of usernames fetched from the database.
 */
function getUsernames() {
    global $pdo;

    // Prepare the SQL query to fetch usernames
    $sql = "SELECT username FROM users";
    $stmt = $pdo->prepare($sql);

    // Execute the query
    $stmt->execute();

    // Fetch all results as an associative array
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
