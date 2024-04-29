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
        $sql = "UPDATE products
                SET name = :name,
                artist = :artist,
                price = :price,
                genre = :genre,
                stock = :stock,
                album_duration = :album_duration,
                imgur = :imgur
                WHERE id = :id";

        $statement = $conn->prepare($sql);
        $statement->bindParam(':name', $_POST['name']);
        $statement->bindParam(':artist', $_POST['artist']);
        $statement->bindParam(':price', $_POST['price']);
        $statement->bindParam(':genre', $_POST['genre']);
        $statement->bindParam(':stock', $_POST['stock']);
        $statement->bindParam(':album_duration', $_POST['album_duration']);
        $statement->bindParam(':imgur', $_POST['imgur']);
        $statement->bindParam(':id', $_POST['id']);
        
        $statement->execute();

        echo "Album successfully updated.";
    } catch(PDOException $error) {
        echo "Error updating album: " . $error->getMessage();
    }
}

// Fetch album data for editing
if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id = :id";
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $album = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo "Error fetching album: " . $error->getMessage();
    }
} else {
    echo "No album ID provided.";
    exit;
}
?>

<h2>Edit an album</h2>
<form method="post">
    <?php foreach ($album as $key => $value) : ?>
        <?php if ($key !== 'id') : ?>
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>">
        <?php else: ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>">
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>
