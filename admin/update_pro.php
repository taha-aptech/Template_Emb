<?php 
include 'auth_check.php'; 
include 'header.php'; 
    include 'dbconfig.php'; 
   ?>

<?php
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $des = $_POST['des'];
    $price = $_POST['price'];
    $cat_id = $_POST['cat_id'];
    $image_name = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];

    if(!empty($image_name)){
        move_uploaded_file($tmp_image, "uploads/$image_name");
        $sql = "UPDATE products SET name='$name', des='$des', price='$price', image='$image_name', cat_id='$cat_id' WHERE id='$id'";
    } else {
        $sql = "UPDATE products SET name='$name', des='$des', price='$price', cat_id='$cat_id' WHERE id='$id'";
    }

    $run = mysqli_query($conn, $sql);
    if($run){
        echo "<script>alert('Product Updated'); window.location.href='view_product.php';</script>";
    } else {
        echo "<script>alert('Update Failed');</script>";
    }
}
?>

<div class="container my-5">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Update Product</h6>
                <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM products WHERE id = $id";
                    $run = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($run);
                ?>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="mb-3">
                        <label>Product Name</label>
                        <input type="text" class="form-control" name="name" value="<?= $row['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea class="form-control" name="des"><?= $row['des'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="number" class="form-control" name="price" value="<?= $row['price'] ?>">
                    </div>
                    <div class="mb-3">
                        <label>Current Image</label><br>
                        <img src="uploads/<?= $row['image'] ?>" width="80"><br>
                        <input type="file" class="form-control mt-2" name="image">
                    </div>
                    <div class="mb-3">
                        <label>Select Category</label>
                        <select class="form-control" name="cat_id">
                            <?php 
                            $cats = mysqli_query($conn, "SELECT * FROM category");
                            while($cat = mysqli_fetch_array($cats)){
                                $selected = $cat['id'] == $row['cat_id'] ? 'selected' : '';
                                echo "<option value='{$cat['id']}' $selected>{$cat['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="edit">Update Product</button>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

