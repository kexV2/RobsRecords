<?php

// Database connection parameters
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get the count of unique artists
$sql = "SELECT COUNT(DISTINCT artist) AS artist_count FROM Products";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
// Fetch the result
    $row = $result->fetch_assoc();
    $artistCount = $row["artist_count"];

// Display the count of unique artists
    echo "Number of unique artists: " . $artistCount;
} else {
    echo "No records found";
}

// Close connection
$conn->close();

?>