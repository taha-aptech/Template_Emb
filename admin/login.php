<?php 
session_start();
include 'dbconfig.php'; 

?>


<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $run = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($run);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];

        if ($user['role'] == 'admin') {
            header("Location: dashboard.php");
        } else {
            header("Location: ../users/index.php");
        }
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}

include 'header.php'; 
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h4>Login</h4>
            <form method="POST">
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-success" name="login">Login</button>
                <p>Don't have an account? <a href="signup.php">Register here</a></p>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
