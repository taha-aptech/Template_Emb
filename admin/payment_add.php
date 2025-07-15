<?php
include 'auth_check.php';
include 'header.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$orders = mysqli_query($conn, "SELECT id FROM orders");

if (isset($_POST['submit'])) {
    $order_id = $_POST['order_id'];
    $amount = $_POST['amount'];
    $method = $_POST['method'];
    $status = $_POST['status'];
    $paid_at = $_POST['paid_at'];

    $sql = "INSERT INTO payment (order_id, amount, method, status, paid_at)
            VALUES ('$order_id', '$amount', '$method', '$status', '$paid_at')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Payment added'); window.location.href='payment_view.php';</script>";
    } else {
        echo "<script>alert('Failed to add');</script>";
    }
}
?>

<div class="container my-4">
    <h4>Add Payment</h4>
    <form method="POST">
        <div class="mb-2">
            <label>Order</label>
            <select name="order_id" class="form-control" required>
                <option value="">Select Order</option>
                <?php while($row = mysqli_fetch_assoc($orders)) { ?>
                <option value="<?= $row['id'] ?>">Order #<?= $row['id'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Amount</label>
            <input type="number" name="amount" step="0.01" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Method</label>
            <select name="method" class="form-control">
                <option value="cash">Cash</option>
                <option value="credit_card">Credit Card</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="easypaisa">EasyPaisa</option>
                <option value="jazzcash">JazzCash</option>
            </select>
        </div>
        <div class="mb-2">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="paid">Paid</option>
                <option value="unpaid">Unpaid</option>
                <option value="pending">Pending</option>
            </select>
        </div>
        <div class="mb-2">
            <label>Paid At</label>
            <input type="datetime-local" name="paid_at" class="form-control" required>
        </div>
        <button name="submit" class="btn btn-success">Add Payment</button>
    </form>
</div>

<?php include 'footer.php'; ?>
