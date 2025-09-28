<?php
include_once("include/sidebar.php");
include("../config/connectDB.php");
include("../config/authen.php");
include("../controllers/attendcontroller.php");
include("../controllers/dashboard_controller.php");
?>

<div class="container mt-4">
  <div class="row">
    <div class="col-12 col-md-6 mb-4">
      <div class="card text-center">
        <div class="card-header bg-warning text-dark fw-bold">Leave Request</div>
        <div class="card-body">
          <h5 class="card-title">pending_request :<?= $row['pending_request']; ?></h5> <!--to show the number of pending request -->
          <canvas id="pendingPie" width="200" height="200"></canvas>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 mb-4">
      <div class="card">
        <div class="card-header bg-info text-white fw-bold">Employee by each Department</div>
        <div class="card-body">
          <canvas id="departmentChart" width="400" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-primary text-white fw-bold">Attendance Report </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-dark">
              <tr>
                <th>Employee</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Late</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($attend_row = $attend_result->fetch_assoc()): ?><!-- to retrieve data from the database-->
                <tr>
                  <td><?= $attend_row['employee_name'] ?></td>
                  <td><?= $attend_row['present_count'] ?></td>
                  <td><?= $attend_row['absent_count'] ?></td>
                  <td><?= $attend_row['late_count'] ?></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  const pieCtx = document.getElementById('pendingPie').getContext('2d');
  new Chart(pieCtx, {
    type: 'pie',
    data: {
      labels: ['Pending', ' Other'],
      datasets: [{
        label: ' Leave Request',
        data: [<?= $row['pending_request']; ?>, <?= $row_req['other_req'];?>], // to retrieve number of total leave request and number of pending request
        backgroundColor: ['#f1c40f', '#2ecc71']
      }]
    }
  });

  const ctx = document.getElementById('departmentChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [<?= $labels; ?>],
      datasets: [{
        label: ' Employee',
        data: [<?= $data; ?>],
        backgroundColor: 'rgba(75, 192, 192, 0.5)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<form method="GET" action="">
  <label for="month">Select Month:</label>
  <input type="month" id="month" name="month" value="<?= date('Y-m') ?>"> <!-- retrieve Attendance monthly-->
  <button type="submit">View Report</button>
</form>
<div class="table-responsive">
<table class="table table-bordered text-center mt-4">
  <thead class="table-dark">
    <tr>
      <th>Employee ID</th>
      <th>Month</th>
      <th>Total Days</th>
      <th>Present</th>
      <th>Absent</th>
      <th>Late</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = $report_result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['employee_name'] ?></td>
        <td><?= $row['month'] ?></td>
        <td><?= $row['total_days'] ?></td>
        <td><?= $row['present_days'] ?></td>
        <td><?= $row['absent_days'] ?></td>
        <td><?= $row['late_days'] ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</div>

