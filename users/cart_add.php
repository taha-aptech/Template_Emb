<?php
include 'dbconfig.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

$check = mysqli_query($conn, "SELECT * FROM addtocart WHERE user_id = $user_id AND product_id = $product_id");
if (mysqli_num_rows($check) > 0) {
    mysqli_query($conn, "UPDATE addtocart SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id");
} else {
    mysqli_query($conn, "INSERT INTO addtocart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)");
}

header('Location: cart.php');
exit;
?>