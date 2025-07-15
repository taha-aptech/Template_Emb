<?php 
include 'header.php'; 
include 'dbconfig.php'; 
include 'auth_check.php'; 

$user_id = $_SESSION['user_id'];
$payments = mysqli_query($conn, "
  SELECT p.*, o.order_date 
  FROM payment p 
  JOIN orders o ON p.order_id = o.id 
  WHERE o.user_id = $user_id 
  ORDER BY p.paid_at DESC
");
?>

<div class="container my-5">
  <h3 class="text-primary mb-4 text-center">My Payments</h3>
  <?php if (mysqli_num_rows($payments) > 0): ?>
    <table class="table table-bordered shadow">
      <thead class="table-light">
        <tr>
          <th>Order ID</th>
          <th>Payment Method</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Paid At</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($payments)): ?>
          <tr>
            <td>#<?= $row['order_id'] ?></td>
            <td><?= $row['method'] ?></td>
            <td>Rs. <?= number_format($row['amount']) ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= date('d-M-Y h:i A', strtotime($row['paid_at'])) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p class="text-center">No payment records found.</p>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
