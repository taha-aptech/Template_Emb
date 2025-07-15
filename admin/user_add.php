<?php
include 'auth_check.php';
include 'header.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit;
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User added'); window.location.href='user_view.php';</script>";
    } else {
        echo "<script>alert('Error adding user');</script>";
    }
}
?>

<div class="container my-4">
    <h4>Add User</h4>
    <form method="POST">
        <div class="mb-2">
            <label>Name</label>
            <input type="text" name="name" required class="form-control">
        </div>
        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" required class="form-control">
        </div>
        <div class="mb-2">
            <label>Password</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <div class="mb-2">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button name="submit" class="btn btn-success">Add User</button>
    </form>
</div>

<?php include 'footer.php'; ?>
