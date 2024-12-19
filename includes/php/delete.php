<?php
require_once '../php/config.php'; // Correct path for including config.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Get the ID from the form

    if (empty($id)) {
        echo "Please provide an Account ID to delete.";
        exit;
    }

    try {
        // Prepare and execute the delete statement
        $sql = "DELETE FROM accounts WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Account with ID $id was successfully deleted.";
        } else {
            echo "No account found with ID $id.";
        }
    } catch (PDOException $e) {
        echo "Error deleting entry: " . $e->getMessage();
    }
} else {
    echo "Invalid request method. Please use the form to submit data.";
}
?>
