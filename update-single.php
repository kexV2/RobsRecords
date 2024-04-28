<?php
// Include config.php
include 'config.php';

// Create connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $sql = "UPDATE employees
                SET firstname = :firstname,
                lastname = :lastname,
                email = :email,
                password = :password,
                employeeUsername = :employeeUsername
                WHERE employeeid = :employeeid";

        $statement = $conn->prepare($sql);
        $statement->bindParam(':firstname', $_POST['firstname']);
        $statement->bindParam(':lastname', $_POST['lastname']);
        $statement->bindParam(':email', $_POST['email']);
        $statement->bindParam(':password', $_POST['password']);
        $statement->bindParam(':employeeUsername', $_POST['employeeUsername']);
        $statement->bindParam(':employeeid', $_POST['employeeid']);
        
        $statement->execute();

        echo "User successfully updated.";
    } catch(PDOException $error) {
        echo "Error updating user: " . $error->getMessage();
    }
}

// Fetch user data for editing
if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $sql = "SELECT * FROM employees WHERE employeeid = :id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $employees = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo "Error fetching user: " . $error->getMessage();
    }
} else {
    echo "No user ID provided.";
    exit;
}
?>

<h2>Edit a user</h2>
<form method="post">
    <?php foreach ($employees as $key => $value) : ?>
        <?php if ($key !== 'employeeid') : ?>
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>">
        <?php else: ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>">
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>
