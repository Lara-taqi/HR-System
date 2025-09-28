<?php
include "../views/include/header.php";
include "../views/include/sidebar.php";
include "../controllers/leavereq_controller.php";
?>
<link rel="stylesheet" href="../public/css/style.css">
<div class="container mt-5">
  <div class="card shadow-lg border-0 rounded-3">
    <div class="card-header bg-primary text-white text-center">
      Leave Request Form
    </div>
    <div class="card-body">
      <form method="post" class="formstyle">
        <input type="hidden" name="Leaves_id" value="<?= $editEmployee['Leaves_id'] ?? '' ?>">
        <section class="emp_info">
          <div class="col">
            <select name="employee_id" class="form-control" required>
              <option value="" disabled selected>Select Employee</option>
              <?php
              $employees = $conn->query("SELECT employee_id, employee_name FROM employee");
              while ($emp = $employees->fetch_assoc()) : ?>
                <option value="<?= $emp['employee_id'] ?>" <?= ($editEmployee && $editEmployee['employee_id'] == $emp['employee_id']) ? 'selected' : '' ?>>
                  <?= $emp['employee_name'] ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="col">
            <select name="leave_type" class="form-control" required>
              <option value="">Leave Type</option>
              <option value="Sick Leave">Sick Leave</option>
              <option value="Annual Leave">Annual Leave</option>
              <option value="Casual Leave">Casual Leave</option>
              <option value="Maternity Leave">Maternity Leave</option>
              <option value="Paternity Leave">Paternity Leave</option>
              <option value="Study Leave">Study Leave</option>
              <option value="Unpaid Leave">Unpaid Leave</option>
              <option value="Compassionate Leave">Compassionate Leave</option>
              <option value="Marriage Leave">Marriage Leave</option>
              <option value="Personal Leave">Personal Leave</option>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <input type="date" class="form-control" id="startDate" name="star_date" onfocus="this.type='date'" onblur="if(!this.value) this.type='text'" placeholder="From date">
            </div>
            <div class="col-md-6 mb-3">
              <input type="date" class="form-control" id="endDate" name="end_date" onfocus="this.type='date'" onblur="if(!this.value) this.type='text'" placeholder="To date">
            </div>
          </div>

          <button type="submit" class="btn btn-success w-100" name="add">Send Request</button>
        </section>
      </form>
    </div>
  </div>
</div>
