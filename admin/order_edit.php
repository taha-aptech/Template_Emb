<?php
include 'auth_check.php';
include 'header.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE id = $id"));
$users = mysqli_query($conn, "SELECT id, name FROM users");

if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET user_id='$user_id', status='$status' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Order updated'); window.location.href='order_view.php';</script>";
    } else {
        echo "<script>alert('Update failed');</script>";
    }
}
?>

<div class="container my-4">
    <h4>Edit Order</h4>
    <form method="POST">
        <div class="mb-2">
            <label>Customer</label>
            <select name="user_id" class="form-control">
                <?php while($user = mysqli_fetch_assoc($users)) { ?>
                <option value="<?= $user['id'] ?>" <?= $user['id'] == $order['user_id'] ? 'selected' : '' ?>>
                    <?= $user['name'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Status</label>
            <select name="status" class="form-control">
                <?php 
                $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
                foreach($statuses as $status) {
                    $selected = $status == $order['status'] ? 'selected' : '';
                    echo "<option value='$status' $selected>" . ucfirst($status) . "</option>";
                }
                ?>
            </select>
        </div>
        <button name="update" class="btn btn-primary">Update Order</button>
    </form>
</div>

<?php include 'footer.php'; ?>
