<?php
$host = 'localhost'; // Your database host
$dbname = 'RobsRecords'; // Your database name
$username = 'root'; // Your database username
$password = 'sqlisgay1'; // Your database password

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