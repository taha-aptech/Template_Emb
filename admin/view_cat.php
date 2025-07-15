<?php 
include 'auth_check.php'; 
include 'header.php'; 
 include 'dbconfig.php'; 
 
?>
   
    <div class="container my-5">
    <h6 class="mb-4 display-4 fs-4">Category List</h6>
        <div class="row g-4">
            <div class="col-sm-12 col-md-6">
                <!-- <div class="bg-light rounded h-100 p-4"> -->
                 
                 <!-- Table Start -->
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Category Sr.</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                    $count = 1;
                    $sql = "SELECT * FROM category";
                    $run = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($run)) {
                    ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>
                                    <a href="delete_cat.php?id=<?php echo $row['id']; ?>"
                                        onclick="return confirm('Are you sure you want to delete this category?');"
                                        class="btn btn-danger btn-sm">Delete</a>
                                         
                                         <a href="update_cat.php?id=<?php echo $row['id']; ?>"
                                        class="btn btn-warning btn-sm">Update</a>
                                </td>
                               
                            </tr>
                            <?php 
                    $count++;
}
?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

<!-- Table End -->



<?php include 'footer.php' ; ?>