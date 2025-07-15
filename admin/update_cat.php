<?php 
    include 'auth_check.php'; 
    include 'header.php';
      include 'dbconfig.php';
      
?>

<?php
if(isset($_POST['edit'])){
$id = $_POST['id'];  
$name = $_POST['name'];  


 $update = "UPDATE category SET name = '$name'  where id = '$id'";
  $run = mysqli_query($conn, $update);
  if($run){
    echo "<script>alert('Category Name Updated'); window.location.href='view_cat.php'; </script>";
    
  }
  else{
    echo "<script>alert('Category Name Not Updated') </script>";

  }
}


?>

   <!-- Form Start -->
   <div class="container my-5">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Update Category</h6>
                            <?php 
                            if(isset($_GET['id'])){
                                $up_id= $_GET['id'];
                                $sql = "SELECT * FROM category where id  = $up_id";
                                $run = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_array($run)){

                            
                            ?>
                            <form method="POST">
                            <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>">
                                  
                                </div>
                              
                                <button type="submit" class="btn btn-primary " name="edit">Update Category</button>
                            </form>

                            <?php
                                }

                            }
                            
                            ?>

                        </div>
                    </div>
                
                </div>
            </div>
            <!-- Form End -->

<?php include 'footer.php'; ?>


