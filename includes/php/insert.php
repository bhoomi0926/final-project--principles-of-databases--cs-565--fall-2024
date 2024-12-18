<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Insert Account</legend>
        <label for="app_name">Application Name:</label>
        <input type="text" name="app_name" id="app_name" placeholder="Application Name" required>
        <br>

        <label for="url">URL:</label>
        <input type="text" name="url" id="url" placeholder="URL">
        <br>

        <label for="username">Select Username:</label>
        <?php
            // Get all usernames from the database
            $rows = getUsernames(); 
            echo '<select name="username" id="username" required>';
            echo '<option value="" disabled selected>Select Username</option>';
            foreach ($rows as $row) {
                echo '<option value="'.$row["username"].'">'.$row["username"].'</option>';
            }
            echo '</select>';
        ?>
        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <br>

        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" placeholder="Comment"></textarea>
        <br>

        <input type="hidden" name="submitted" value="INSERT_ACCOUNT">
        <p><input type="submit" value="Insert Account"></p>
    </fieldset>
</form>
