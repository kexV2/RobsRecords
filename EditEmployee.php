<?php
// Include config.php to get database connection details
require 'config.php';

$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
    // Use variables from config.php to create the connection
    $dsn = "mysql:host=$host;dbname=$dbname";
    $connection = new PDO($dsn, $username, $password, $options);
    
    // Execute SQL query to fetch data
    $sql = "SELECT * FROM employees";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(); // Fetch all rows
    
} catch (PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
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
