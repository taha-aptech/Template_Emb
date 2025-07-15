<?php 
include 'header.php'; 
include 'dbconfig.php'; 
include 'auth_check.php'; 

$user_id = $_SESSION['user_id'];
$orders = mysqli_query($conn, "
  SELECT o.id, o.order_date, o.status, SUM(od.quantity * od.price) AS total 
  FROM orders o 
  JOIN order_details od ON o.id = od.order_id 
  WHERE o.user_id = $user_id 
  GROUP BY o.id 
  ORDER BY o.order_date DESC
");
?>

<div class="container my-5">
  <h3 class="text-primary mb-4 text-center">My Orders</h3>
  <?php if (mysqli_num_rows($orders) > 0): ?>
    <table class="table table-bordered shadow">
      <thead class="table-light">
        <tr>
          <th>Order ID</th>
          <th>Order Date</th>
          <th>Status</th>
          <th>Total Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($orders)): ?>
          <tr>
            <td>#<?= $row['id'] ?></td>
            <td><?= date('d-M-Y h:i A', strtotime($row['order_date'])) ?></td>
            <td><?= $row['status'] ?></td>
            <td>Rs. <?= number_format($row['total']) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p class="text-center">You have not placed any orders yet.</p>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
