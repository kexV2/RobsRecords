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
    $sql = "SELECT * FROM products";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(); // Fetch all rows
    
} catch (PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
}
?>


<h2>Products</h2>
<table>
    <thead>
    <link rel="stylesheet" href="assets/css/EditEmployee.css">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Artist</th>
        <th>Price</th>
        <th>Genre</th>
        <th>Stock</th>
        <th>Album Duration</th>
        <th>Imgur</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
    <tr>
        <td><?php echo isset($row["id"]) ? htmlspecialchars($row["id"]) : ''; ?></td>
        <td><?php echo isset($row["name"]) ? htmlspecialchars($row["name"]) : ''; ?></td>
        <td><?php echo isset($row["artist"]) ? htmlspecialchars($row["artist"]) : ''; ?></td>
        <td><?php echo isset($row["price"]) ? htmlspecialchars($row["price"]) : ''; ?></td>
        <td><?php echo isset($row["genre"]) ? htmlspecialchars($row["genre"]) : ''; ?></td>
        <td><?php echo isset($row["stock"]) ? htmlspecialchars($row["stock"]) : ''; ?></td>
        <td><?php echo isset($row["album_duration"]) ? htmlspecialchars($row["album_duration"]) : ''; ?></td>
        <td><?php echo isset($row["imgur"]) ? htmlspecialchars($row["imgur"]) : ''; ?></td>
        <td><a href="update-singlestock.php?id=<?php echo isset($row["id"]) ? htmlspecialchars($row["id"]) : ''; ?>">Edit</a></td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>
<a href="dashboard.html">Back to home</a>
