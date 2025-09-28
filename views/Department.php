<link rel="stylesheet" href="../public/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/js/script.js"></script>
<?php
include "../controllers/department_controller.php";
?>

<form method="post">
  <section class="emp_info">
    <div class="form-outline">
      <input type="text" class="form-control" name="department_name" required />
      <label class="form-label">Department Name</label>
    </div>
    <button type="submit" name="add" class="btn btn-light">Add</button>
  </section>
</form>

<table class="table table-striped mt-5">
  <thead>
    <tr>
      <th>Department_id</th>
      <th>Department_name</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $department->fetch_assoc()): ?>
      <tr>
        <td><?= $row['department_id'] ?></td>
        <td><?= $row['department_name'] ?></td>
        <td>
          <a href="#" class="btn btn-warning btn-sm"
             data-bs-toggle="modal"
             data-bs-target="#editModal"
             data-id="<?= $row['department_id'] ?>"
             data-name="<?= $row['department_name'] ?>"
             onclick="loadEditData(this)">Edit</a>
          <a href="?delete=<?= $row['department_id'] ?>" class="btn btn-danger btn-sm"
             onclick="return confirm('Delete this department?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="Department.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="department_id" id="edit_department_id">
          <div class="form-outline mb-3">
            <label class="form-label">Department Name</label>
            <input type="text" class="form-control" name="department_name" id="edit_department_name" required />
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="update" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>


