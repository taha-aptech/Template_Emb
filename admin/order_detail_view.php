<?php
include 'auth_check.php';
include 'header.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$query = "SELECT od.*, p.name AS product_name, o.id AS order_number 
          FROM order_details od 
          JOIN products p ON od.product_id = p.id 
          JOIN orders o ON od.order_id = o.id";
$result = mysqli_query($conn, $query);
?>

<div class="container my-4">
    <h4>Order Details</h4>
    <a href="order_detail_add.php" class="btn btn-success mb-2">Add Order Detail</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Order #</th><th>Product</th><th>Quantity</th><th>Price</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td>Order #<?= $row['order_id'] ?></td>
                <td><?= htmlspecialchars($row['product_name']) ?></td>
                <td><?= $row['quantity'] ?></td>
                <td>Rs <?= $row['price'] ?></td>
                <td>
                    <a href="order_detail_edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="order_detail_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this item?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
