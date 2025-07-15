<?php
include 'auth_check.php';
include 'header.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

// Get users for dropdown
$users = mysqli_query($conn, "SELECT id, name FROM users");

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO orders (user_id, status) VALUES ('$user_id', '$status')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Order added'); window.location.href='order_view.php';</script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}
?>

<div class="container my-4">
    <h4>Add Order</h4>
    <form method="POST">
        <div class="mb-2">
            <label>Customer</label>
            <select name="user_id" class="form-control" required>
                <option value="">Select Customer</option>
                <?php while($user = mysqli_fetch_assoc($users)) { ?>
                <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
        <button name="submit" class="btn btn-success">Add Order</button>
    </form>
</div>

<?php include 'footer.php'; ?>
