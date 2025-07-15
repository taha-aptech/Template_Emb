<?php include 'header.php'; include 'dbconfig.php'; ?>

<?php
if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already registered');</script>";
    } else {
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'customer')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Signup successful'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Signup failed');</script>";
        }
    }
}
?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h3 class="text-primary text-center mb-4">Create an Account</h3>
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="signup" class="btn btn-primary w-100">Sign Up</button>
        <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
