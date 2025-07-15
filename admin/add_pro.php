<?php 
include 'auth_check.php'; 
include 'header.php'; 
include 'dbconfig.php'; 
?>

<?php
// Handle product submission
if(isset($_POST['add_product'])){
    $name = $_POST['name'];
    $des = $_POST['des'];
    $price = $_POST['price'];
    $cat_id = $_POST['cat_id'];

    // Handle image upload
    $image_name = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    $target = "uploads/" . basename($image_name);

    if(move_uploaded_file($tmp_image, $target)){
        $insert = "INSERT INTO products (name, des, price, image, cat_id) 
                   VALUES ('$name', '$des', '$price', '$image_name', '$cat_id')";
        $run = mysqli_query($conn, $insert);

        if($run){
            echo "<script>alert('Product added'); window.location.href='view_pro.php';</script>";
        } else {
            echo "<script>alert('Product not added');</script>";
        }
    } else {
        echo "<script>alert('Image upload failed');</script>";
    }
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Add New Product</h6>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="des" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Select Category</label>
                            <select name="cat_id" class="form-control" required>
                                <option value="">-- Select Category --</option>
                                <?php
                                    $cats = mysqli_query($conn, "SELECT * FROM category");
                                    while($row = mysqli_fetch_assoc($cats)){
                                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

