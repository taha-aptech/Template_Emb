<?php
include 'auth_check.php';
include 'header.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM payment WHERE id = $id"));
$orders = mysqli_query($conn, "SELECT id FROM orders");

if (isset($_POST['update'])) {
    $order_id = $_POST['order_id'];
    $amount = $_POST['amount'];
    $method = $_POST['method'];
    $status = $_POST['status'];
    $paid_at = $_POST['paid_at'];

    $sql = "UPDATE payment SET order_id='$order_id', amount='$amount', method='$method', status='$status', paid_at='$paid_at' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Updated'); window.location.href='payment_view.php';</script>";
    } else {
        echo "<script>alert('Update failed');</script>";
    }
}
?>

<div class="container my-4">
    <h4>Edit Payment</h4>
    <form method="POST">
        <div class="mb-2">
            <label>Order</label>
            <select name="order_id" class="form-control">
                <?php while($row = mysqli_fetch_assoc($orders)) { ?>
                <option value="<?= $row['id'] ?>" <?= $row['id'] == $data['order_id'] ? 'selected' : '' ?>>
                    Order #<?= $row['id'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="<?= $data['amount'] ?>">
        </div>
        <div class="mb-2">
            <label>Method</label>
            <select name="method" class="form-control">
                <?php
                $methods = ['cash', 'credit_card', 'bank_transfer', 'easypaisa', 'jazzcash'];
                foreach ($methods as $m) {
                    $selected = $m == $data['method'] ? 'selected' : '';
                    echo "<option value='$m' $selected>" . ucfirst($m) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Status</label>
            <select name="status" class="form-control">
                <?php
                $statuses = ['paid', 'unpaid', 'pending'];
                foreach ($statuses as $s) {
                    $selected = $s == $data['status'] ? 'selected' : '';
                    echo "<option value='$s' $selected>" . ucfirst($s) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Paid At</label>
            <input type="datetime-local" name="paid_at" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($data['paid_at'])) ?>">
        </div>
        <button name="update" class="btn btn-primary">Update</button>
    </form>
</div>

<?php include 'footer.php'; ?>
