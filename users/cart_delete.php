<?php
include 'dbconfig.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM addtocart WHERE id = $id");
header('Location: cart.php');
exit;
?>