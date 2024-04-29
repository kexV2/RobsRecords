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

if (isset($_POST["id"])) {
    try {
        $id = $_POST["id"];
        $sql = "DELETE FROM products WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $success = "Stock item with ID ". $id. " successfully deleted";

        // Redirect back to DeleteStock.php after successful deletion
        header("Location: DeleteStock.php?success=".urlencode($success));
        exit();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

try {
    $sql = "SELECT * FROM products";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<h2>Delete Stock</h2>
<?php 
if (isset($_GET["success"])) {
    echo htmlspecialchars($_GET["success"]);
}
?>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Artist</th>
        <th>Price</th>
        <th>Genre</th>
        <th>Stock</th>
        <th>Album Duration</th>
        <th>Imgur</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["artist"]; ?></td>
            <td><?php echo $row["price"]; ?></td>
            <td><?php echo $row["genre"]; ?></td>
            <td><?php echo $row["stock"]; ?></td>
            <td><?php echo $row["album_duration"]; ?></td>
            <td><?php echo $row["imgur"]; ?></td>
            <td><form method="post" action="DeleteStock.php">
                <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                <button type="submit">Delete</button>
            </form></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="dashboard.html">Back to home</a>
