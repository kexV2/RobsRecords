<?php
$host = "localhost";
$username = "root";
$password = "admin";
$dbname = "robsrecords";


$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $connection = new PDO($dsn, $username, $password, $options);
} catch (PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
}
?>