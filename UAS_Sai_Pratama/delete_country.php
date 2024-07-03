<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

include('config.php');

$id = $_GET['id'];
$query = "DELETE FROM countries WHERE id='$id'";
if ($conn->query($query) === TRUE) {
    header('Location: index.php');
    exit;
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
