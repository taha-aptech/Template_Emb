<?php
include 'auth_check.php';
include 'header.php';
include 'dbconfig.php';

// Only admin allowed
if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<div class="container my-4">
    <h4>All Users</h4>
    <a href="user_add.php" class="btn btn-success mb-2">Add New User</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Created At</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['role'] ?></td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <a href="user_edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="user_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete user?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
