<?php
session_start();
if ($_SESSION['user_role'] != 'employees') {
    header("Location: login.php");
    exit();
}
?>

<h1>Welcome to the Employee Dashboard</h1>
<p>Here you can view and manage the records in the database.</p>