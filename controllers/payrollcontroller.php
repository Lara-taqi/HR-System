<?php
include "../config/connectDB.php";

if (isset($_POST['add'])) { 
    $salary_id=$_POST['salary_id'];
    $employee_id = $_POST['employee_id'];
    $month = $_POST['salary_month'];
    $bonus = $_POST['salary_bonus'];
    $deductions = $_POST['salary_deductions'];

    $stmt = $conn->prepare("INSERT INTO salary ( employee_id, salary_month, salary_bonus,salary_deductions) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isii",  $employee_id , $month, $bonus,$deductions);
    $stmt->execute();
    header("Location: payroll.php");
    exit();
}
//use query  to calcualte the final_salary= net_salary =(salary"from employee table +bonus")-deductions 
$result = $conn->query("
    SELECT s.salary_id, s.employee_id, e.employee_name, s.salary_month, 
           s.salary_bonus, s.salary_deductions,
           (COALESCE(e.employee_salary,0) + s.salary_bonus - s.salary_deductions) AS final_salary
    FROM salary s
    JOIN employee e ON s.employee_id = e.employee_id
    ORDER BY s.salary_id DESC
");
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM salary WHERE salary_id = $id");
    header("Location: payroll.php");
    exit();
}
$editMode = false;
$editEmployee = null;

if (isset($_GET['edit'])) {
    $editId = intval($_GET['edit']);
    $editQuery = $conn->query("SELECT * FROM salary WHERE salary_id = $editId");
    $editEmployee = $editQuery->fetch_assoc();
    $editMode = true;
}

if (isset($_POST['update'])) {
    $id = intval($_POST['salary_id']);  
    $employee_id = intval($_POST['employee_id']); 
    $month = $_POST['salary_month'];
    $bonus = $_POST['salary_bonus'];
    $deductions = $_POST['salary_deductions'];

    $stmt = $conn->prepare("UPDATE salary SET employee_id=?, salary_month=?, salary_bonus=?,salary_deductions=? WHERE salary_id=?");
    $stmt->bind_param("isiii", $employee_id, $month, $bonus,$deductions, $id);
    $stmt->execute();

    header("Location: payroll.php");
    exit();
}
    
?>