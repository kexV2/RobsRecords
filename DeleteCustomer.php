<?php
require_once 'config.php';

// Create connection
try {
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    $dsn = "mysql:host=$host;dbname=$dbname";
    $connection = new PDO($dsn, $username, $password, $options);
} catch (PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
}

if (isset($_GET["id"])) {
    try {
        $id = $_GET["id"];
        $sql = "DELETE FROM customers WHERE customerid = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $success = "Customer ". $id. " successfully deleted";

        // Redirect back to DeleteEmployee.php after successful deletion
        header("Location: DeleteCustomer.php?success=".urlencode($success));
        exit();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

try {
    $sql = "SELECT * FROM customers";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<h2>Delete Employees</h2>
<?php 
if (isset($_GET["success"])) {
    echo htmlspecialchars($_GET["success"]);
}
?>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Employee Username</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo $row["CustomerId"]; ?></td>
            <td><?php echo $row["firstname"]; ?></td>
            <td><?php echo $row["lastname"]; ?></td>
            <td><?php echo $row["username"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><a href="DeleteCustomer.php?id=<?php echo $row["CustomerId"]; ?>">Delete</a></td>



        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="dashboard.html">Back to home</a>