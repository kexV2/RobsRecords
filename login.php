<?php
session_start(); // Make sure session is started
require_once 'config.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username and password are correct
    $query = "SELECT * FROM admins WHERE adminusername = :username AND password = :password";
    $statement = $connection->prepare($query);
    $statement->bindParam(":username", $username);
    $statement->bindParam(":password", $password);
    $statement->execute();

    // Check if a row was returned
    if ($statement->rowCount() > 0) {
        // Login successful, store user role in session and redirect to dashboard
        $_SESSION['loggedIn'] = true;
        $_SESSION['user_role'] = 'admin'; // Assuming all users in this table are admins
        header("Location: index.php");
        exit;
    } else {
        // Login failed, display error message
        $error = "Invalid username or password";
    }
}

// Close connection
$connection = null;
?>