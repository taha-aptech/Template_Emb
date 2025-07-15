<?php 
include 'header.php'; 
include 'dbconfig.php'; 
include 'auth_check.php'; ?>

<?php
$user_id = $_SESSION['user_id'];
$cart_items = mysqli_query($conn, "
  SELECT c.id, p.name, p.price, p.image, c.quantity, (p.price * c.quantity) AS total
  FROM addtocart c
  JOIN products p ON c.product_id = p.id
  WHERE c.user_id = $user_id
");

$grand_total = 0;
?>

<div class="container my-5">
  <h3 class="text-primary text-center mb-4">Your Cart</h3>
  <?php if (mysqli_num_rows($cart_items) > 0): ?>
    <table class="table table-bordered shadow">
      <thead class="table-light">
        <tr>
          <th>Image</th>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($cart_items)):
          $grand_total += $row['total']; ?>
          <tr>
            <td><img src="images/<?= $row['image'] ?>" alt="img" width="60"></td>
            <td><?= $row['name'] ?></td>
            <td>Rs. <?= $row['price'] ?></td>
            <td>
              <form method="POST" action="cart_update.php" class="d-flex">
                <input type="hidden" name="cart_id" value="<?= $row['id'] ?>">
                <input type="number" name="quantity" value="<?= $row['quantity'] ?>" min="1" class="form-control me-2" style="width: 70px;">
                <button type="submit" class="btn btn-sm btn-primary">Update</button>
              </form>
            </td>
            <td>Rs. <?= $row['total'] ?></td>
            <td>
              <a href="cart_delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Remove item?')">Remove</a>
            </td>
          </tr>
        <?php endwhile; ?>
        <tr>
          <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
          <td colspan="2"><strong>Rs. <?= $grand_total ?></strong></td>
        </tr>
      </tbody>
    </table>
    <div class="text-end">
      <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
    </div>
  <?php else: ?>
    <p class="text-center">Your cart is empty.</p>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
