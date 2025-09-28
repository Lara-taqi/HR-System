<?php
include "../views/include/header.php";
include "../views/include/sidebar.php";
include "../config/connectDB.php";

if (isset($_POST['add'])) {//add new employee to the database
    $name = $_POST['employee_name'];
    $email = $_POST['employee_email'];
    $salary = $_POST['employee_salary'];
    $department = $_POST['department_id'];

    $stmt = $conn->prepare("INSERT INTO employee (employee_name, employee_email, employee_salary, department_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $name, $email, $salary, $department);
    $stmt->execute();
    header("Location: employee.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);//use intval to prevent injection 
    $conn->query("DELETE FROM employee WHERE employee_id = $id");
    header("Location: employee.php");
    exit();
}

if (isset($_POST['update'])) {
    $id = intval($_POST['employee_id']);
    $name = $_POST['employee_name'];
    $email = $_POST['employee_email'];
    $salary = $_POST['employee_salary'];
    $department = $_POST['department_id'];

    $stmt = $conn->prepare("UPDATE employee SET employee_name=?, employee_email=?, employee_salary=?, department_id=? WHERE employee_id=?");
    $stmt->bind_param("ssdii", $name, $email, $salary, $department, $id);
    $stmt->execute();
    header("Location: employee.php");
    exit();
}

$editMode = false;
$editEmployee = null;

if (isset($_GET['edit'])) {
    $editId = intval($_GET['edit']);
    $editQuery = $conn->query("SELECT * FROM employee WHERE employee_id = $editId");
    $editEmployee = $editQuery->fetch_assoc();
    $editMode = true;
}

$departments = $conn->query("SELECT department_id, department_name FROM department");
$employees = $conn->query("SELECT e.*, d.department_name FROM employee e LEFT JOIN department d ON e.department_id = d.department_id");
?>