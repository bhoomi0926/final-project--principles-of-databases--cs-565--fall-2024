<?php
// db.php - Contains database connection and account insertion function

// Assuming you have set up a PDO connection
$dsn = 'mysql:host=localhost;dbname=passwords';
$username = 'passwords_user';
$password = 'k(D2Whiue9d8yD';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Insert account function
function insertAccount($site_name, $site_url, $first_name, $last_name, $username, $email, $password, $comment) {
    global $pdo;

    // Check if the email already exists
    $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $emailCount = $stmt->fetchColumn();

    if ($emailCount > 0) {
        echo "Email already exists. Please use a different email.";
        return false;
    }

    // Encrypt the password
    $encryption_key = 'encryption_key'; // Change this to a secure key
    $iv = substr(hash('sha256', $encryption_key), 0, 16); // Initialization vector
    $encrypted_password = openssl_encrypt($password, 'aes-128-cbc', $encryption_key, 0, $iv);

    try {
        // Begin transaction
        $pdo->beginTransaction();

        // Insert into the accounts table
        $sql = "INSERT INTO accounts (name, url, comment) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$site_name, $site_url, $comment]);
        $account_id = $pdo->lastInsertId();

        // Insert into the users table
        $sql = "INSERT INTO users (first_name, last_name, email, username) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$first_name, $last_name, $email, $username]);
        $user_id = $pdo->lastInsertId();

        // Insert the encrypted password into the passwords table
        $sql = "INSERT INTO passwords (account_id, user_id, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$account_id, $user_id, $encrypted_password]);

        // Commit transaction
        $pdo->commit();
        return true;
    } catch (Exception $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        echo "Failed to insert account: " . $e->getMessage();
        return false;
    }
}
?>
