<?php
require_once 'config.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Create a PDO instance
    $pdo = new PDO($dsn, $username, $password);

    // Check if the username and password are correct
    $query = "SELECT * FROM users WHERE username = :username AND password = :password";
    $statement = $pdo->prepare($query);
    $statement->bindParam(":username", $username);
    $statement->bindParam(":password", $password);
    $statement->execute();

    // Check if a row was returned
    if ($statement->rowCount() > 0) {
        // Login successful, redirect to dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        // Login failed, display error message
        $error = "Invalid username or password";
    }
}

// Close connection
$pdo = null;

?>

<!-- Your HTML form and error message display code here -->