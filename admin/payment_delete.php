<?php
include 'auth_check.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM payment WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Deleted'); window.location.href='payment_view.php';</script>";
} else {
    echo "<script>alert('Delete failed'); window.location.href='payment_view.php';</script>";
}
