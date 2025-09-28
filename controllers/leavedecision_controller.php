<?php
include "../config/connectDB.php";

if (isset($_GET['approve'])) {//when we click on the button <a href ... > the status will change 
    $id = intval($_GET['approve']);
    $conn->query("UPDATE leaves SET leave_status='Approved' WHERE Leaves_id=$id");
    header("Location: leave_decision.php");
    exit();
}

if (isset($_GET['reject'])) {
    $id = intval($_GET['reject']);
    $conn->query("UPDATE leaves SET leave_status='Rejected' WHERE Leaves_id=$id");
    header("Location: leave_decision.php");
    exit();
}

if (isset($_GET['pending'])) {
    $id = intval($_GET['pending']);
    $conn->query("UPDATE leaves SET leave_status='Pending' WHERE Leaves_id=$id");
    header("Location: leave_decision.php");
    exit();
}

$leaves = $conn->query("
    SELECT l.*, e.employee_name 
    FROM leaves l
    JOIN employee e ON l.employee_id = e.employee_id
    ORDER BY l.star_date DESC
");
?>