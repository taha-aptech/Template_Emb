<?php
include 'auth_check.php';
include 'header.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$orders = mysqli_query($conn, "SELECT id FROM orders");
$products = mysqli_query($conn, "SELECT id, name FROM products");

if (isset($_POST['submit'])) {
    $order_id = $_POST['order_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) 
            VALUES ('$order_id', '$product_id', '$quantity', '$price')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Order detail added'); window.location.href='order_detail_view.php';</script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}
?>

<div class="container my-4">
    <h4>Add Order Detail</h4>
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
            <label>Product</label>
            <select name="product_id" class="form-control" required>
                <option value="">Select Product</option>
                <?php while($row = mysqli_fetch_assoc($products)) { ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Quantity</label>
            <input type="number" name="quantity" required class="form-control">
        </div>
        <div class="mb-2">
            <label>Price</label>
            <input type="number" step="0.01" name="price" required class="form-control">
        </div>
        <button name="submit" class="btn btn-success">Add Detail</button>
    </form>
</div>

<?php include 'footer.php'; ?>
