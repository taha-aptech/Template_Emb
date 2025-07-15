<?php include 'dbconfig.php'; 
include 'auth_check.php'; 
?>

<?php
if(isset($_GET['id']))
{
    $del_id= $_GET['id'];
    $sql2 = "DELETE from category where id = '".$del_id."'";
    $run2 = mysqli_query($conn, $sql2);
    if($run2){
        echo "<script>alert('product deleted'); window.location.href='view_cat.php'; </script>";
        
      }
      else{
        echo "<script>alert('No product deleted') </script>";
    
      }
}

?>