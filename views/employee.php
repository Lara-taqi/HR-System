<link rel="stylesheet" href="../public/css/style.css">
<?php
include "../controllers/employee_controller.php"
?>
<form method="post">
  <input type="hidden" name="employee_id" value="<?= $editEmployee['employee_id'] ?? '' ?>">
  <section class="emp_info">
    <div class="col">
      <input type="text" class="form-control" name="employee_name" value="<?= $editEmployee['employee_name'] ?? '' ?>" required placeholder="Employee Name" />
    </div>

    <div class="col">
      <input type="email" class="form-control" name="employee_email" value="<?= $editEmployee['employee_email'] ?? '' ?>" required placeholder="Employee Email" />
    </div>

    <div class="col">
      <input type="number" step="0.01" class="form-control" name="employee_salary" value="<?= $editEmployee['employee_salary'] ?? '' ?>" required  placeholder="Employee Salary"/>
    </div>

    <div class="col">
      <select name="department_id" class="form-select" required>
        <option value="" disabled selected>Choose Department</option>
        <?php while ($row = $departments->fetch_assoc()): 
          $selected = ($editEmployee && $editEmployee['department_id'] == $row['department_id']) ? 'selected' : '';
        ?>
          <option value="<?= $row['department_id'] ?>" <?= $selected ?>><?= $row['department_name'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <div >
      <?php if ($editMode): ?>
        <button type="submit" name="update" class="btn btn-secondary">Update</button>
        <a href="employee.php" class="btn btn-danger">Cancel</a>
      <?php else: ?>
        <button type="submit" name="add" class="btn btn-light">Add</button>
      <?php endif; ?>
    </div>
  </section>
</form>
<table class="table table-striped mt-5">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Salary</th>
      <th>Department</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $employees->fetch_assoc()): ?>
      <tr>
        <td><?= $row['employee_name'] ?></td>
        <td><?= $row['employee_email'] ?></td>
        <td><?= $row['employee_salary'] ?></td>
        <td><?= $row['department_name'] ?></td>
        <td>
          <a href="?edit=<?= $row['employee_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="?delete=<?= $row['employee_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this employee?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
