function loadEditData(button) {
  const id = button.getAttribute("data-id");
  const name = button.getAttribute("data-name");

  document.getElementById("edit_department_id").value = id;
  document.getElementById("edit_department_name").value = name;
}