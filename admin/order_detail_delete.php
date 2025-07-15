<?php
include 'auth_check.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM order_details WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Deleted'); window.location.href='order_detail_view.php';</script>";
} else {
    echo "<script>alert('Error deleting'); window.location.href='order_detail_view.php';</script>";
}
