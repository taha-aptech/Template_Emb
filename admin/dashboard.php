<?php 
include 'auth_check.php'; 
include 'dbconfig.php'; 
include 'header.php'; 
?>

<?php

// Fetch counts from database

$cat_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM category"));
$prod_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM products"));
$order_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM orders"));
$user_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users"));



?>
<!-- <div class="container my-2">
    <div class="d-flex justify-content-end">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div> -->

<div class="container mt-4">
    <div class="row mb-3">

        <!-- Categories Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Categories</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $cat_count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Products</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $prod_count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $order_count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user_count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>
