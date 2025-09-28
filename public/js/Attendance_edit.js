  const editBtns = document.querySelectorAll('.editAttendanceBtn');
  editBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-id');
      const employee = btn.getAttribute('data-employee');
      const date = btn.getAttribute('data-date');
      const status = btn.getAttribute('data-status');

      document.getElementById('edit_attendance_id').value = id;
      document.getElementById('edit_employee_name').value = employee;
      document.getElementById('edit_attendance_date').value = date;
      document.getElementById('edit_attendance_status').value = status;
    });
  });