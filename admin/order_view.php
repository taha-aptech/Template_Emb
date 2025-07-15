<?php
include 'auth_check.php';
include 'header.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$query = "SELECT orders.*, users.name AS customer_name FROM orders 
          JOIN users ON orders.user_id = users.id 
          ORDER BY orders.id DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container my-4">
    <h4>All Orders</h4>
    <a href="order_add.php" class="btn btn-success mb-2">Add New Order</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Customer</th><th>Date</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['customer_name']) ?></td>
                <td><?= $row['order_date'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="order_edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="order_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this order?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
