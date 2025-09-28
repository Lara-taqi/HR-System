<?php
include "../config/connectDB.php";

if (isset($_POST['add'])) { //add leave request 
    $leave_id=$_POST['Leaves_id'];
    $employee_id = $_POST['employee_id'];
    $leave_type= $_POST['leave_type'];
    $stardate = $_POST['star_date'];
    $enddate = $_POST['end_date'];

    $stmt = $conn->prepare("INSERT INTO leaves ( employee_id, leave_type, star_date,end_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss",  $employee_id , $leave_type, $stardate,$enddate);
    $stmt->execute();
    header("Location: leave_request.php");
    exit();
}
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM leaves WHERE leaves_id = $id");
    header("Location: leave_request.php");
    exit();
}
$editMode = false;
$editEmployee = null;

if (isset($_GET['edit'])) {
    $editId = intval($_GET['edit']);
    $editQuery = $conn->query("SELECT * FROM leaves WHERE leaves_id = $editId");
    $editEmployee = $editQuery->fetch_assoc();
    $editMode = true;
}

if (isset($_POST['update'])) {
    $leave_id   = intval($_POST['Leaves_id']); 
    $employee_id = intval($_POST['employee_id']); 
    $leave_type  = $_POST['leave_type'];
    $stardate   = $_POST['star_date'];
    $enddate     = $_POST['end_date'];

    $stmt = $conn->prepare("UPDATE leaves SET employee_id=?, leave_type=?, star_date=?, end_date=? WHERE leave_id=?");
    $stmt->bind_param("isssi", $employee_id, $leave_type, $startdate, $enddate, $leave_id);
    $stmt->execute();

    header("Location: leave_request.php");
    exit();
}



?>