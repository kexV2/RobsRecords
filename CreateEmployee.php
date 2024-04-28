<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "admin";
$database = "robsrecords";

// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

// Check connection
if ($conn === false) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    try {
        $new_employee = array(
            "employeeID" => $_POST['employeeID'],
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "employeeUsername" => $_POST['employeeUsername']
        );

        $columns = implode(", ", array_keys($new_employee));
        $values = ":" . implode(", :", array_keys($new_employee));

        $sql = "INSERT INTO employees ($columns) values ($values)";

        $statement = $conn->prepare($sql);

        // Bind values
        foreach ($new_employee as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        echo $new_employee['firstname']. ' successfully added';
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
<title>Add Employee</title>
<link rel="stylesheet" href="assets/css/CreateEmployee.css">
</head>
<body>
<div class="container">
    <h2>Add an Employee</h2>
    <form method="post">
        <label for="employeeID">Employee ID</label>
        <input type="text" name="employeeID" id="employeeID">
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname">
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname">
        <label for="email">Email Address</label>
        <input type="text" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <label for="employeeUsername">Employee Username</label>
        <input type="text" name="employeeUsername" id="employeeUsername">
        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="dashboard.html">Back to home</a>
</div>
</body>
</html>
