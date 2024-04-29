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
    $sql = "SELECT * FROM customers";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(); // Fetch all rows
    
} catch (PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
}
?>

<h2>Customers</h2>
<table>
    <thead>
        <link rel="stylesheet" href="assets/css/EditCustomer.css">
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email Address</th>
            <th>Password</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
    <tr>
        <td><?php echo isset($row["CustomerId"]) ? htmlspecialchars($row["CustomerId"]) : 'N/A'; ?></td>
        <td><?php echo isset($row["firstname"]) ? htmlspecialchars($row["firstname"]) : 'N/A'; ?></td>
        <td><?php echo isset($row["lastname"]) ? htmlspecialchars($row["lastname"]) : 'N/A'; ?></td>
        <td><?php echo isset($row["username"]) ? htmlspecialchars($row["username"]) : 'N/A'; ?></td>
        <td><?php echo isset($row["email"]) ? htmlspecialchars($row["email"]) : 'N/A'; ?></td>
        <td><?php echo isset($row["password"]) ? htmlspecialchars($row["password"]) : 'N/A'; ?></td>
        <td><a href="update-singlecustomer.php?id=<?php echo isset($row["CustomerId"]) ? htmlspecialchars($row["CustomerId"]) : 'N/A'; ?>">Edit</a></td>
    </tr>
<?php endforeach; ?>

</tbody>

</table>
<a href="dashboard.html">Back to home</a>
