<?php 
include 'header.php'; 
include 'dbconfig.php'; 
include 'auth_check.php'; 

$user_id = $_SESSION['user_id'];
$cart = mysqli_query($conn, "SELECT * FROM addtocart WHERE user_id = $user_id");

if (mysqli_num_rows($cart) == 0) {
    echo "<script>alert('Cart is empty'); window.location.href='index.php';</script>";
    exit;
}

if (isset($_POST['checkout'])) {
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip_code']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $total = 0;

    // Insert into orders table
    mysqli_query($conn, "INSERT INTO orders (user_id, order_date, status) VALUES ($user_id, NOW(), 'Pending')");
    $order_id = mysqli_insert_id($conn);

    // Add to order_details
    while ($item = mysqli_fetch_assoc($cart)) {
        $product_id = $item['product_id'];
        $qty = $item['quantity'];

        $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT price FROM products WHERE id = $product_id"));
        $price = $product['price'];
        $total += $price * $qty;

        mysqli_query($conn, "INSERT INTO order_details (order_id, product_id, quantity, price) 
            VALUES ($order_id, $product_id, $qty, $price)");
    }

    // Insert into checkout
    mysqli_query($conn, "INSERT INTO checkout (user_id, order_id, address, city, zip_code, phone, created_at) 
        VALUES ($user_id, $order_id, '$address', '$city', '$zip', '$phone', NOW())");

    // Insert into payment
    mysqli_query($conn, "INSERT INTO payment (order_id, amount, method, status, paid_at) 
        VALUES ($order_id, $total, '$method', 'Pending', NOW())");

    // Clear cart
    mysqli_query($conn, "DELETE FROM addtocart WHERE user_id = $user_id");

    echo "<script>alert('Order placed successfully!'); window.location.href='orders.php';</script>";
}
?>

<div class="container my-5">
  <h3 class="text-primary mb-4 text-center">Checkout</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Full Address</label>
      <textarea name="address" class="form-control" rows="3" required></textarea>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">City</label>
        <input type="text" name="city" class="form-control" required>
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-label">ZIP Code</label>
        <input type="text" name="zip_code" class="form-control" required>
      </div>
      <div class="col-md-3 mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" required>
      </div>
    </div>
  <div class="mb-4">
  <label class="form-label">Payment Method</label>
  <select name="method" class="form-select" required>
    <option value="cash_on_delivery">Cash on Delivery</option>
    <option value="credit_card">Credit Card</option>
    <option value="easypaisa">Easypaisa</option>
    <option value="jazzcash">JazzCash</option>
  </select>
</div>
    <button type="submit" name="checkout" class="btn btn-success w-100">Place Order</button>
  </form>
</div>

<?php include 'footer.php'; ?>
