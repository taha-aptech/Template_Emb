<?php
include 'auth_check.php';
include 'header.php';
include 'dbconfig.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit;
}

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = $id"));

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name='$name', email='$email', role='$role', password='$password' WHERE id=$id";
    } else {
        $sql = "UPDATE users SET name='$name', email='$email', role='$role' WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User updated'); window.location.href='user_view.php';</script>";
    } else {
        echo "<script>alert('Update failed');</script>";
    }
}
?>

<div class="container my-4">
    <h4>Edit User</h4>
    <form method="POST">
        <div class="mb-2">
            <label>Name</label>
            <input type="text" name="name" value="<?= $user['name'] ?>" required class="form-control">
        </div>
        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" value="<?= $user['email'] ?>" required class="form-control">
        </div>
        <div class="mb-2">
            <label>New Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-2">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="customer" <?= $user['role'] == 'customer' ? 'selected' : '' ?>>Customer</option>
                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        <button name="update" class="btn btn-primary">Update</button>
    </form>
</div>

<?php include 'footer.php'; ?>


