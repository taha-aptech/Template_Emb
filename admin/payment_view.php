<?php
include 'auth_check.php';
include 'header.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$result = mysqli_query($conn, "SELECT p.*, o.id AS order_number 
    FROM payment p 
    JOIN orders o ON p.order_id = o.id 
    ORDER BY p.id DESC");
?>

<div class="container my-4">
    <h4>All Payments</h4>
    <a href="payment_add.php" class="btn btn-success mb-2">Add Payment</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Order #</th><th>Amount</th><th>Method</th><th>Status</th><th>Paid At</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td>#<?= $row['order_id'] ?></td>
                <td>Rs <?= $row['amount'] ?></td>
                <td><?= ucfirst($row['method']) ?></td>
                <td><?= ucfirst($row['status']) ?></td>
                <td><?= $row['paid_at'] ?></td>
                <td>
                    <a href="payment_edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="payment_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this payment?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
