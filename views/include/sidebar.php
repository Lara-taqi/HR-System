<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}?>
<div class="sidebar">
  <h4>Dashboard</h4>
  <ul class="nav flex-column mb-auto">
    <li><a href="dashboard.php" class="nav-link "><i class="bi bi-house"></i> Dashboard</a></li>
    <li><a href="employee.php" class="nav-link "><i class="bi bi-person-square"></i> Employee</a></li>
    <li><a href="Department.php" class="nav-link "><i class="bi bi-building"></i> Department</a></li>
    <li><a href="leave_request.php" class="nav-link "><i class="bi bi-box-arrow-in-right"></i> Leave request</a></li>
    <li><a href="leave_decision.php" class="nav-link "><i class="bi bi-box-arrow-left"></i> Leave Decision</a></li>    
    <li><a href="Attendance.php" class="nav-link "><i class="bi bi-calendar-check"></i> Attendence</a></li>
    <li><a href="payroll.php" class="nav-link "><i class="bi bi-currency-dollar"></i> Payroll</a></li>
    <li><a href="logout.php" class="nav-link "><i class="bi bi-lock"></i> LogOut</a></li>

  </ul>
</div>