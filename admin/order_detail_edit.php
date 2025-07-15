<?php
include 'auth_check.php';
include 'header.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM order_details WHERE id = $id"));

$orders = mysqli_query($conn, "SELECT id FROM orders");
$products = mysqli_query($conn, "SELECT id, name FROM products");

if (isset($_POST['update'])) {
    $order_id = $_POST['order_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $sql = "UPDATE order_details SET 
            order_id = '$order_id', 
            product_id = '$product_id', 
            quantity = '$quantity', 
            price = '$price' 
            WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Updated'); window.location.href='order_detail_view.php';</script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}
?>

<div class="container my-4">
    <h4>Edit Order Detail</h4>
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
            <label>Product</label>
            <select name="product_id" class="form-control">
                <?php while($row = mysqli_fetch_assoc($products)) { ?>
                <option value="<?= $row['id'] ?>" <?= $row['id'] == $data['product_id'] ? 'selected' : '' ?>>
                    <?= $row['name'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-2">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="<?= $data['quantity'] ?>">
        </div>
        <div class="mb-2">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= $data['price'] ?>">
        </div>
        <button name="update" class="btn btn-primary">Update</button>
    </form>
</div>

<?php include 'footer.php'; ?>
