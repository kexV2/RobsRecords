<?php
require_once 'config.php';

// Create connection
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Check connection
if ($conn === false) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    try {
        $new_customer = array(
            "customerid" => $_POST['customerid'],
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "username" => $_POST['username'],
            "email" => $_POST['email'],
            "password" => $_POST['password']
        );

        $columns = implode(", ", array_keys($new_customer));
        $values = ":" . implode(", :", array_keys($new_customer));

        $sql = "INSERT INTO customers ($columns) VALUES ($values)";

        $statement = $conn->prepare($sql);

        // Bind values
        foreach ($new_customer as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        echo $new_customer['firstname']. ' successfully added';
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Customer</title>
<link rel="stylesheet" href="assets/css/CreateCustomer.css">
</head>
<body>
<div class="container">
    <h2>Add a Customer</h2>
    <form method="post">
        <label for="customerid">Customer ID</label>
        <input type="text" name="customerid" id="customerid">
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname">
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <label for="email">Email Address</label>
        <input type="text" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="dashboard.html">Back to home</a>
</div>
</body>
</html>
