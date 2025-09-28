<?php
include "../views/include/header.php";
include "../views/include/sidebar.php";
include "../controllers/payrollcontroller.php";
?>
<div class="container mt-5">
  <form method="post">
    <input type="hidden" name="salary_id" value="<?= $editEmployee['salary_id'] ?? '' ?>">
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
        <input type="month" name="salary_month" class="form-control" value="<?= $editEmployee['salary_month'] ?? '' ?>" required>
      </div>

      <div class="col">
        <input type="number" name="salary_bonus" class="form-control" placeholder="Employee Bouns" value="<?= $editEmployee['salary_bonus'] ?? '' ?>" required>
      </div>

      <div class="col">
        <input type="number" name="salary_deductions" class="form-control" placeholder="salary_deductions" value="<?= $editEmployee['salary_deductions'] ?? '' ?>" required>
      </div>

      <div>
        <?php if ($editMode) : ?>
          <button type="submit" name="update" class="btn btn-secondary">Update</button>
          <a href="attendance.php" class="btn btn-danger">Cancel</a>
        <?php else : ?>
          <button type="submit" name="add" class="btn btn-light">Add</button>
        <?php endif; ?>
      </div>
    </section>
  </form>

  <table class="table table-striped mt-5">
    <thead>
      <tr>
        <th>ID</th>
        <th>Employee</th>
        <th>Month</th>
        <th>Bouns</th>
        <th>Deductions</th>
        <th>Net Salary</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
          <td><?= $row['salary_id'] ?></td>
          <td><?= $row['employee_name'] ?></td>
          <td><?= $row['salary_month'] ?></td>
          <td><?= $row['salary_bonus'] ?></td>
          <td><?= $row['salary_deductions'] ?></td>
          <td><?= $row['final_salary'] ?></td>
          <td>
            <a href="?edit=<?= $row['salary_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="?delete=<?= $row['salary_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this employee?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</div>
</div>
