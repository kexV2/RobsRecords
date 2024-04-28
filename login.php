<?php
session_start();

// Establish connection to the database
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "robsrecords";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check if the entered credentials exist in the database for admins
    $sqlAdmin = "SELECT * FROM admins WHERE adminusername='$username' AND password='$password'";
    $resultAdmin = $conn->query($sqlAdmin);

    // SQL query to check if the entered credentials exist in the database for customers
    $sqlCustomer = "SELECT * FROM customers WHERE username='$username' AND password='$password'";
    $resultCustomer = $conn->query($sqlCustomer);

    // Check if a matching record is found for admins
    if ($resultAdmin->num_rows > 0) {
        // Login successful for admin, set session variables and redirect to success page for admins
        $row = $resultAdmin->fetch_assoc();
        $_SESSION['username'] = $row['adminusername'];
        $_SESSION['user_role'] = 'admin';
        $_SESSION['loggedIn'] = true;
        header("Location: index.php");
        exit(); // Ensure script stops executing after redirect
    } elseif ($resultCustomer->num_rows > 0) {
        // Login successful for customer, set session variables and redirect to success page for customers
        $row = $resultCustomer->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_role'] = 'customer';
        header("Location: customer_success.php");
        exit(); // Ensure script stops executing after redirect
    } else {
        // Login failed, redirect back to login page
        header("Location: login.php?error=Invalid+username+or+password");
        exit(); // Ensure script stops executing after redirect
    }
}

$conn->close();
?>

