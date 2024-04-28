<?php
class Product {
    private $conn;

    public function __construct($servername, $username, $password, $database) {
        // Create connection
        $servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
        $username = "root"; // Your MySQL username
        $password = "admin"; // Your MySQL password
        $dbname = "robsrecords"; // Your database name

        $this->conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getProducts() {
        // SQL query to fetch products
        $sql = "SELECT name, artist, genre, price FROM products";
        $result = $this->conn->query($sql);

        $products = array();

        // Check if there are results
        if ($result->num_rows > 0) {
            // Fetch associative array of results
            while($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        // Close result set
        $result->close();

        return $products;
    }

    public function __destruct() {
        // Close connection
        $this->conn->close();
    }
}

// Usage:
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // Your MySQL username
$password = "sqlisgay1"; // Your MySQL password
$dbname = "robsrecords"; // Your database name

$productObj = new Product($servername, $username, $password, $database);
$products = $productObj->getProducts();

// You can now use $products array which contains product data
foreach ($products as $product) {
    echo "Name: " . $product['name'] . ", Artist: " . $product['artist'] . ", Genre: " . $product['genre'] . ", Price: " . $product['price'] . "<br>";
}
?>