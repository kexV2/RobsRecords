<?php
// Establish connection to the database
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // Your MySQL username
$password = "sqlisgay1"; // Your MySQL password
$dbname = "robsrecords"; // Your database name


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from form submission
$adminusername = $_POST['username']; // corrected variable name
$password = $_POST['password'];

// SQL query to check if the entered credentials exist in the database for admins
$sqlAdmin = "SELECT * FROM admins WHERE adminusername='$adminusername' AND password='$password'";
$resultAdmin = $conn->query($sqlAdmin);

// SQL query to check if the entered credentials exist in the database for customers
$sqlCustomer = "SELECT * FROM customers WHERE username='$adminusername' AND password='$password'";
$resultCustomer = $conn->query($sqlCustomer);

// Check if a matching record is found for admins
if ($resultAdmin->num_rows > 0) {
    // Login successful for admin, redirect to success page for admins
    header("Location: admin_success.php");
    exit(); // Ensure script stops executing after redirect
} elseif ($resultCustomer->num_rows > 0) {
    // Login successful for customer, redirect to success page for customers
    header("Location: customer_success.php");
    exit(); // Ensure script stops executing after redirect
} else {
    // Login failed, redirect back to login page
    header("Location: localhost");
    exit(); // Ensure script stops executing after redirect
}

$conn->close();
?>