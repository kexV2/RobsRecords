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
        $sql = "UPDATE customers
        SET firstname = :firstname,
        lastname = :lastname,
        username = :username,
        email = :email,
        password = :password
        WHERE CustomerId = :customerid";



        $statement = $conn->prepare($sql);
        $statement->bindParam(':firstname', $_POST['firstname']);
        $statement->bindParam(':lastname', $_POST['lastname']);
        $statement->bindParam(':username', $_POST['username']);
        $statement->bindParam(':email', $_POST['email']);
        $statement->bindParam(':password', $_POST['password']);
        $statement->bindParam(':customerid', $_POST['CustomerId']);


        
        $statement->execute();

        echo "Customer successfully updated.";
    } catch(PDOException $error) {
        echo "Error updating Customer: " . $error->getMessage();
    }
}

// Fetch user data for editing
if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $sql = "SELECT * FROM customers WHERE CustomerId = :id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $employees = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo "Error fetching customer: " . $error->getMessage();
    }
} else {
    echo "No customer ID provided.";
    exit;
}
?>

<h2>Edit a user</h2>
<form method="post">
    <?php foreach ($employees as $key => $value) : ?>
        <?php if ($key !== 'CustomerId') : ?>
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>">
        <?php else: ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>">
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>
