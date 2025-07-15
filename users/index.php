
<?php include 'header.php'; include 'dbconfig.php'; ?>

<div class="container my-5">
  <h2 class="text-center mb-4">Shop by Category</h2>
  <div class="row">
    <?php
    $cat_query = mysqli_query($conn, "SELECT * FROM category");
    while ($cat = mysqli_fetch_assoc($cat_query)) {
    ?>
      <div class="col-md-4 mb-4">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($cat['name']) ?></h5>
            <a href="products.php?cat_id=<?= $cat['id'] ?>" class="btn btn-primary">View Products</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php include 'footer.php'; ?>
