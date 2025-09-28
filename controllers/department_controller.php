<?php
include "../views/include/header.php";
include "../views/include/sidebar.php";
include "../config/connectDB.php";

if (isset($_POST['add'])) {
    $department_name = $_POST['department_name'];
    $stmt = $conn->prepare("INSERT INTO department (department_name) VALUES (?)");
    $stmt->bind_param("s", $department_name);
    $stmt->execute();
    header("Location: Department.php");
    exit();
}

if (isset($_POST['update'])) {
    $department_id = intval($_POST['department_id']);
    $department_name = $_POST['department_name'];

    $stmt = $conn->prepare("UPDATE department SET department_name = ? WHERE department_id = ?");
    $stmt->bind_param("si", $department_name, $department_id);
    $stmt->execute();
    header("Location: Department.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM department WHERE department_id = $id");
    header("Location: Department.php");
    exit();
}

$department = $conn->query("SELECT * FROM department ORDER BY department_id ASC");
?>