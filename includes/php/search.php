<?php
// search.php

// Include the database connection file
require_once 'db.php'; // Adjust the path if necessary

// Check if a search term was provided
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $searchTerm = $_GET['query'];

    try {
        // Prepare the SQL query to search accounts by name
        $sql = "SELECT * FROM accounts WHERE name LIKE ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["%$searchTerm%"]);

        // Fetch all matching results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display the results
        if (!empty($results)) {
            echo "<h2>Search Results:</h2><ul>";
            foreach ($results as $result) {
                echo "<li>" . htmlspecialchars($result['name']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No results found for '$searchTerm'.</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<p>Please provide a search term.</p>";
}
?>
