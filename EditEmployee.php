<?php
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

try {
    $sql = "SELECT * FROM employees";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<h2>Employees</h2>
<table>
    <thead>
    <link rel="stylesheet" href="assets/css/EditEmployee.css">
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th>Password</th>
        <th>Employee Username</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
    <tr>
        <td><?php echo isset($row["employeeid"]) ? htmlspecialchars($row["employeeid"]) : ''; ?></td>
        <td><?php echo isset($row["firstname"]) ? htmlspecialchars($row["firstname"]) : ''; ?></td>
        <td><?php echo isset($row["lastname"]) ? htmlspecialchars($row["lastname"]) : ''; ?></td>
        <td><?php echo isset($row["email"]) ? htmlspecialchars($row["email"]) : ''; ?></td>
        <td><?php echo isset($row["password"]) ? htmlspecialchars($row["password"]) : ''; ?></td>
        <td><?php echo isset($row["employeeUsername"]) ? htmlspecialchars($row["employeeUsername"]) : ''; ?></td>
        <td><a href="update-single.php?id=<?php echo isset($row["employeeid"]) ? htmlspecialchars($row["employeeid"]) : ''; ?>">Edit</a></td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>
<a href="index.php">Back to home</a> 
