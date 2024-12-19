<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $site_name = $_POST['site_name'];
    $comment = $_POST['comment'];

    if (empty($id) || (!isset($site_name) && !isset($comment))) {
        echo "Please provide the Account ID and at least one field to update.";
        exit;
    }

    try {
        $fieldsToUpdate = [];
        $parameters = [':id' => $id];

        if (!empty($site_name)) {
            $fieldsToUpdate[] = "site_name = :site_name";
            $parameters[':site_name'] = $site_name;
        }

        if (!empty($comment)) {
            $fieldsToUpdate[] = "comment = :comment";
            $parameters[':comment'] = $comment;
        }

        if (count($fieldsToUpdate) > 0) {
            $sql = "UPDATE accounts SET " . implode(', ', $fieldsToUpdate) . " WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($parameters);
            echo "Entry updated successfully!";
        } else {
            echo "No fields to update.";
        }
    } catch (PDOException $e) {
        echo "Error updating entry: " . $e->getMessage();
    }
}
?>
