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
        $sql = "DELETE FROM employees WHERE employeeid = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $success = "Employee ". $id. " successfully deleted";

        // Redirect back to DeleteEmployee.php after successful deletion
        header("Location: DeleteEmployee.php?success=".urlencode($success));
        exit();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

try {
    $sql = "SELECT * FROM employees";
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
            <td><?php echo $row["employeeid"]; ?></td>
            <td><?php echo $row["firstname"]; ?></td>
            <td><?php echo $row["lastname"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["employeeUsername"]; ?></td>
            <td><a href="DeleteEmployee.php?id=<?php echo $row["employeeid"]; ?>">Delete</a></td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php">Back to home</a>