<?php 
include 'header.php'; 
include 'dbconfig.php'; 
// include 'auth_check.php'; 
?>

<?php
if (!isset($_GET['cat_id'])) {
    echo "<script>window.location.href='index.php';</script>";
    exit;
}
$cat_id = $_GET['cat_id'];
$cat = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM category WHERE id = $cat_id"));
$products = mysqli_query($conn, "SELECT * FROM products WHERE cat_id = $cat_id");
?>

<div class="container my-5">
  <h3 class="text-primary text-center mb-4">Products in <?= htmlspecialchars($cat['name']) ?></h3>
  <div class="row">
    <?php while ($p = mysqli_fetch_assoc($products)) { ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow">
          <img src="images/<?= $p['image'] ?>" class="card-img-top img-fluid" alt="<?= htmlspecialchars($p['name']) ?>" style="height:250px; object-fit:cover">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
            <p class="card-text"><?= $p['des'] ?></p>
            <p class="text-primary fw-bold">Rs. <?= $p['price'] ?></p>

            <form method="POST" action="cart_add.php">
              <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
              <div class="input-group mb-2">
                <button class="btn btn-outline-secondary" type="button" onclick="decreaseQty(this)">−</button>
                <input type="number" name="quantity" value="1" min="1" class="form-control text-center" style="max-width: 70px;">
                <button class="btn btn-outline-secondary" type="button" onclick="increaseQty(this)">+</button>
              </div>
              <button type="submit" class="btn btn-success w-100">Add to Cart</button>
            </form>
            
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<script>
function increaseQty(btn) {
  const input = btn.parentElement.querySelector('input[name="quantity"]');
  input.value = parseInt(input.value) + 1;
}
function decreaseQty(btn) {
  const input = btn.parentElement.querySelector('input[name="quantity"]');
  if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
}
</script>

<?php include 'footer.php'; ?>
