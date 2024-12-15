<?php
require_once 'db.php'; // Ensure this file contains your database connection code

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submitted']) && $_POST['submitted'] === '3') {
    $artistId = trim($_POST['artist-id']); // Get the artist ID
    $artistName = trim($_POST['artist-name']); // Get the artist name

    // Validate inputs
    if (!empty($artistId) && !empty($artistName)) {
        // Prepare SQL statement
        $query = "INSERT INTO artist (artist_id, artist_name) VALUES (?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("is", $artistId, $artistName); // Bind parameters
            if ($stmt->execute()) {
                echo "New artist inserted successfully!";
            } else {
                echo "Error inserting artist: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Failed to prepare the SQL statement.";
        }
    } else {
        echo "Both fields are required.";
    }
} else {
    echo "Invalid form submission.";
}
?>
