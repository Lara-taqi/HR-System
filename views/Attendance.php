<?php
include "../controllers/attendcontroller.php";
?>
<div class="container mt-5">
  <form method="post">
    <input type="hidden" name="attendance_id" value="<?= $editEmployee['attendance_id'] ?? '' ?>">
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
        <input type="date" name="attendance_date" class="form-control" value="<?= $editEmployee['attendance_date'] ?? '' ?>" required>
      </div>

      <div class="col">
        <select name="attendance_status" class="form-control" required>
          <option value="">Select Status</option>
          <option value="Present" <?= ($editEmployee && $editEmployee['attendance_status'] == 'Present') ? 'selected' : '' ?>>Present</option>
          <option value="Absent" <?= ($editEmployee && $editEmployee['attendance_status'] == 'Absent') ? 'selected' : '' ?>>Absent</option>
          <option value="Late" <?= ($editEmployee && $editEmployee['attendance_status'] == 'Late') ? 'selected' : '' ?>>Late</option>
        </select>
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
        <th>Date</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
          <td><?= $row['attendance_id'] ?></td>
          <td><?= $row['employee_name'] ?></td>
          <td><?= $row['attendance_date'] ?></td>
          <td><?= $row['attendance_status'] ?></td>
          <td>
            <a href="?edit=<?= $row['attendance_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="?delete=<?= $row['attendance_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this employee?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</div>
</div>
