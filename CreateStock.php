<?php
require_once 'config.php';

// Create connection
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Check connection
if ($conn === false) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    try {
        $new_product = array(
            "id" => $_POST['id'],
            "name" => $_POST['name'],
            "artist" => $_POST['artist'],
            "price" => $_POST['price'],
            "genre" => $_POST['genre'],
            "stock" => $_POST['stock'],
            "album_duration" => $_POST['album_duration'],
            "imgur" => $_POST['imgur']
        );

        $columns = implode(", ", array_keys($new_product));
        $values = ":" . implode(", :", array_keys($new_product));

        $sql = "INSERT INTO products ($columns) VALUES ($values)";

        $statement = $conn->prepare($sql);

        // Bind values
        foreach ($new_product as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        echo $new_product['name']. ' successfully added';
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
<title>Add Product</title>
<link rel="stylesheet" href="assets/css/CreateEmployee.css">
</head>
<body>
<div class="container">
    <h2>Add a Product</h2>
    <form method="post">
        <label for="id">Product ID</label>
        <input type="text" name="id" id="id">
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name">
        <label for="artist">Artist</label>
        <input type="text" name="artist" id="artist">
        <label for="price">Price</label>
        <input type="text" name="price" id="price">
        <label for="genre">Genre</label>
        <input type="text" name="genre" id="genre">
        <label for="stock">Stock</label>
        <input type="text" name="stock" id="stock">
        <label for="album_duration">Album Duration</label>
        <input type="text" name="album_duration" id="album_duration">
        <label for="imgur">Imgur</label>
        <input type="text" name="imgur" id="imgur">
        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="dashboard.html">Back to home</a>
</div>
</body>
</html>
