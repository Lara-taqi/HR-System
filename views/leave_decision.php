<?php
include "../views/include/header.php";
include "../views/include/sidebar.php";
include "../controllers/leavedecision_controller.php";
?>

<div class="container mt-5">
  <div class="card shadow-lg border-0 rounded-3">
    <div class="card-header bg-primary text-white text-center">
       Leave Request Managment
    </div>
    <div class="col">
      <table class="table table-striped mt-5">
        <thead >
          <tr>
            <th>Employee Name</th>
            <th>Leave Type</th>
            <th>From</th>
            <th>To</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $leaves->fetch_assoc()): ?>
          <tr>
            <td><?= $row['employee_name'] ?></td>
            <td><?= $row['leave_type']?></td>
            <td><?= $row['star_date'] ?></td>
            <td><?= $row['end_date'] ?></td>
            <td>
              <?php
                if($row['leave_status'] == 'Pending') echo '<span class="badge bg-warning">Pending</span>';
                elseif($row['leave_status'] == 'Approved') echo '<span class="badge bg-success">Approved</span>';
                elseif($row['leave_status'] == 'Rejected') echo '<span class="badge bg-danger">Rejected</span>';
              ?>
            </td>
            <td>
              <a href="?approve=<?= $row['Leaves_id'] ?>" class="btn btn-success btn-sm">Approve</a>
              <a href="?reject=<?= $row['Leaves_id'] ?>" class="btn btn-danger btn-sm">Reject</a>
              <a href="?pending=<?= $row['Leaves_id'] ?>" class="btn btn-warning btn-sm">Pending</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
