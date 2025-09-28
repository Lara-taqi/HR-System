<?php
session_start();
include "../../config/connectDB.php";
$error="";
if($_SERVER['REQUEST_METHOD']=="POST"){
$Employee_id = $_POST['employee_id'];
$Password = $_POST['password'];
$send = $conn->prepare("SELECT * FROM users WHERE employee_id = ? LIMIT 1");
$send->bind_param("s", $Employee_id);
$send->execute();
$result = $send->get_result();
$fetch = $result->fetch_assoc();

if ($fetch && password_verify($Password, $fetch['password'])) {
        $_SESSION['employee_id'] = $fetch['employee_id'];
        header("Location: ../dashboard.php");
        exit;
    } else {
        $error = "Invalid employee ID or password.";
    }
}




?>