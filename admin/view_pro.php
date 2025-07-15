<?php 
include 'auth_check.php'; 
include 'header.php'; 
include 'dbconfig.php'; 
 ?>

<div class="container my-5">
    <h6 class="mb-4 display-4 fs-4">Product List</h6>
    <div class="row g-4">
        <div class="col-sm-12 col-md-12">
            <table class="table text-center table-bordered">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $count = 1;
                $sql = "SELECT p.*, c.name as category_name FROM products p 
                        JOIN category c ON p.cat_id = c.id";
                $run = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($run)) {
                ?>
                    <tr>
                        <td><?= $count++; ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['des']; ?></td>
                        <td><?= $row['price']; ?></td>
                        <td><img src="uploads/<?= $row['image']; ?>" width="60" height="60"></td>
                        <td><?= $row['category_name']; ?></td>
                        <td>
                            <a href="delete_pro.php?id=<?= $row['id']; ?>"
                               onclick="return confirm('Are you sure to delete this product?');"
                               class="btn btn-danger btn-sm">Delete</a>
                            <a href="update_pro.php?id=<?= $row['id']; ?>" 
                               class="btn btn-warning btn-sm">Update</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
