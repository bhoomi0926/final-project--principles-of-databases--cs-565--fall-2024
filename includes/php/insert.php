<?php
// Include the database connection file
require_once 'db.php';
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Insert Account</legend>

        <label for="app_name">Application Name:</label>
        <input type="text" name="app_name" id="app_name" placeholder="Application Name" required><br><br>

        <label for="url">URL:</label>
        <input type="text" name="url" id="url" placeholder="URL"><br><br>

        <label for="username">Select Username:</label>
        <select name="username" id="username" required>
            <option value="" disabled selected>Select Username</option>
            <?php
            // Fetch usernames and populate the dropdown
            $rows = getUsernames();
            if (!empty($rows)) {
                foreach ($rows as $row) {
                    echo '<option value="' . htmlspecialchars($row["username"]) . '">' . htmlspecialchars($row["username"]) . '</option>';
                }
            } else {
                echo '<option value="" disabled>No usernames available</option>';
            }
            ?>
        </select><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Password" required><br><br>

        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" placeholder="Comment"></textarea><br><br>

        <input type="hidden" name="submitted" value="5">
        <p><input type="submit" value="Insert Account"></p>
    </fieldset>
</form>
