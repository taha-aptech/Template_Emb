<?php
include 'dbconfig.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$cart_id = $_POST['cart_id'];
$quantity = $_POST['quantity'];

mysqli_query($conn, "UPDATE addtocart SET quantity = $quantity WHERE id = $cart_id");
header('Location: cart.php');
exit;
?>