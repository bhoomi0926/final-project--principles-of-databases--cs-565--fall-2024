<?php
require_once 'db.php';  // Ensure db.php is included

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $site_name = $_POST['site_name'];
    $site_url = $_POST['site_url'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $comment = $_POST['comment'];

    // Call the function to insert the account
    $result = insertAccount($site_name, $site_url, $first_name, $last_name, $username, $email, $password, $comment);

    if ($result) {
        echo "Account successfully added!";
    }
}
?>
<!-- Your HTML form for collecting data -->
<form method="POST" action="insert.php">
    <!-- Form fields for site name, URL, user details, etc. -->
    <input type="text" name="site_name" placeholder="Site Name" required>
    <input type="text" name="site_url" placeholder="Site URL" required>
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <textarea name="comment" placeholder="Comment"></textarea>
    <button type="submit">Submit</button>
</form>
