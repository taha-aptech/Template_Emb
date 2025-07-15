<?php include 'dbconfig.php'; 
include 'auth_check.php'; 
?>

<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Get image filename to delete from folder
    $get = mysqli_query($conn, "SELECT image FROM products WHERE id = $id");
    $row = mysqli_fetch_assoc($get);
    $image = $row['image'];

    if(file_exists("uploads/$image")){
        unlink("uploads/$image");
    }

    $del = mysqli_query($conn, "DELETE FROM products WHERE id = $id");

    if($del){
        echo "<script>alert('Product deleted'); window.location.href='view_product.php';</script>";
    } else {
        echo "<script>alert('Delete failed');</script>";
    }
}
?>
