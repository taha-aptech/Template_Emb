<?php 
 include 'auth_check.php'; 
include 'header.php'; 
 include 'dbconfig.php'; 

?>



<?php
if(isset($_POST['add'])){
 $name = $_POST['name'];  
 
 $insert = "INSERT INTO category (name) VALUES ('$name')";
  $run = mysqli_query($conn, $insert);
  if($run){
    echo "<script>alert('Category added'); window.location.href='view_cat.php'; </script>";
    
  }
  else{
    echo "<script>alert('No Category added') </script>";

  }
}


?>


<div class="container my-5">
<div class="row">
            <div class="col-md-6">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Create New Category</h6>
                </div>
                <div class="card-body">
                  <form method="POST" action="">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Add Category Name</label>
                      <input type="text" class="form-control" 
                        placeholder="Enter Category" name="name">
                      
                    </div>
                  
                    <button type="submit" class="btn btn-primary" name="add">Add Category</button>
                  </form>
                </div>
              </div>
              </div>
              </div>

</div>



<?php include 'footer.php'; ?>