<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Final Project | CS 565 | Passwords Assignment</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <header>
      <h1>CRUD Operations via a Web Interface</h1>
    </header>

    <form id="clear-results" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <!-- You can add a clear button if needed -->
    </form>

    <?php
    // Include necessary PHP files
    require_once "includes/php/config.php";
    require_once "includes/php/constants.php";
    require_once "includes/php/db.php";

    // Initialize the action submitted by the form
    $option = $_POST["submitted"] ?? null;

    if ($option !== null) {
        switch ($option) {
            case SEARCH:
                $search = $_POST["search"];
                $table = $_POST["table"];
                switch ($table) {
                    case "users":
                        searchUsers($search);
                        break;
                    case "accounts":
                        searchAccounts($search);
                        break;
                    case "both":
                        searchBoth($search);
                        break;
                }
                break;

            case INSERT_USER:
                $firstName = $_POST["first_name"];
                $lastName = $_POST["last_name"];
                $username = $_POST["username"];
                $email = $_POST["email"];
                if ($firstName == "" || $lastName == "" || $username == "" || $email == "") {
                    echo '<div id="error">User form not fully entered. Please try again.</div>';
                } else {
                    insertUser($firstName, $lastName, $username, $email);
                }
                break;

            case UPDATE_USER:
                $attributeName = $_POST["current-attribute-name"];
                $attribute = $_POST["new-attribute"];
                $queryAttribute = $_POST["query-attribute"];
                $pattern = $_POST["pattern"];
                if ($attribute == "" || $pattern == "") {
                    echo '<div id="error">Update query empty. Please try again.</div>';
                } else {
                    updateUser($attributeName, $attribute, $queryAttribute, $pattern);
                }
                break;

            case DELETE_USER:
                $attributeName = $_POST["current-attribute"];
                $pattern = $_POST["pattern"];
                if ($attributeName == "" || $pattern == "") {
                    echo '<div id="error">Delete query empty. Please try again.</div>';
                } else {
                    deleteUser($attributeName, $pattern);
                }
                break;

            case INSERT_ACCOUNT:
                $appName = $_POST["app_name"];
                $url = $_POST["url"];
                $comment = $_POST["comment"];
                $username = $_POST["username"];
                $password = $_POST["password"];
                if ($appName == ""  || $username == "" || $password == "") {
                    echo '<div id="error">Account form not fully entered. Please try again.</div>';
                } else {
                    insertAccount($appName, $url, $comment, $username, $password);
                }
                break;

            case UPDATE_ACCOUNT:
                $attributeName = $_POST["current-attribute-name"];
                $attribute = $_POST["new-attribute"];
                $queryAttribute = $_POST["query-attribute"];
                $pattern = $_POST["pattern"];
                if ($attribute == "" || $pattern == "") {
                    echo '<div id="error">Update query empty. Please try again.</div>';
                } else {
                    updateAccount($attributeName, $attribute, $queryAttribute, $pattern);
                }
                break;

            case DELETE_ACCOUNT:
                $attributeName = $_POST["current-attribute"];
                $pattern = $_POST["pattern"];
                if ($attributeName == "" || $pattern == "") {
                    echo '<div id="error">Delete query empty. Please try again.</div>';
                } else {
                    deleteAccount($attributeName, $pattern);
                }
                break;
        }
    }

    // Include forms for search, insert, update, and delete operations
    require_once "includes/html/search-form.html";
    require_once "includes/html/update-form.html";
    require_once "includes/html/insert-form.html";
    require_once "includes/html/delete-form.html";
    ?>

  </body>
</html>
