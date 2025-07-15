<?php
include 'auth_check.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit;
}

$id = $_GET['id'];

// prevent self-deletion
if ($_SESSION['user_id'] == $id) {
    echo "<script>alert('You cannot delete yourself!'); window.location.href='user_.php';</script>";
    exit;
}

$sql = "DELETE FROM users WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('User deleted'); window.location.href='user_.php';</script>";
} else {
    echo "<script>alert('Delete failed'); window.location.href='user_.php';</script>";
}
?>


