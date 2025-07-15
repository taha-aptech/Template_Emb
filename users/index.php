<?php include 'header.php'; include 'dbconfig.php'; ?>

<style>
.category-card {
  transition: all 0.3s ease-in-out;
  border: none;
  border-radius: 15px;
}
.category-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 0 25px rgba(0, 123, 255, 0.2);
}
.card-icon {
  font-size: 40px;
  color: #0d6efd;
}
.underline {
  width: 60px;
  height: 4px;
  background: #0d6efd;
  margin: 0 auto 20px;
  border-radius: 2px;
}
</style>

<div class="container my-5">
<h2 class="text-center text-primary fw-bold">Explore Our Shoe Categories</h2>
  <div class="underline"></div>
  <p class="text-center text-muted mb-4">Choose from a wide range of stylish and comfortable footwear for everyone.</p>

  <div class="row mt-4">
    <?php
    $cat_query = mysqli_query($conn, "SELECT * FROM category");
    while ($cat = mysqli_fetch_assoc($cat_query)) {
    ?>
      <div class="col-md-4 mb-4">
        <div class="card category-card shadow text-center p-3">
          <div class="card-body">
            <div class="card-icon mb-3">
              <i class="fas fa-shoe-prints"></i>
            </div>
            <h5 class="card-title text-dark"><?= htmlspecialchars($cat['name']) ?></h5>
              <p class="card-text text-muted small">
              Discover the best selection of <?= strtolower($cat['name']) ?> shoes designed for durability, comfort, and style.
            </p>
            <a href="products.php?cat_id=<?= $cat['id'] ?>" class="btn btn-outline-primary mt-2">
              View Products
            </a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php include 'footer.php'; ?>
