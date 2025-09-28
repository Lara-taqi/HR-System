<?php
include "../config/connectDB.php";
include "./include/header.php";
include "./include/sidebar.php";

if (isset($_POST['add'])) {
    $employee_id = $_POST['employee_id'];
    $date = $_POST['attendance_date'];
    $status = $_POST['attendance_status'];

    $check = $conn->prepare("SELECT * FROM attendance WHERE employee_id=? AND attendance_date=?");
    $check->bind_param("is", $employee_id, $date);
    $check->execute();
    $result_check = $check->get_result();

    if ($result_check->num_rows > 0) { // to prevent duplication in attendance in the same date 
        echo "<script>alert('Attendance for this employee on this date already exists');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO attendance (employee_id, attendance_date, attendance_status) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $employee_id, $date, $status);
        $stmt->execute();
        echo "<script>alert('Attendance added successfully');</script>";
    }
}

$employees = $conn->query("SELECT employee_id, employee_name FROM employee");

$result = $conn->query("
    SELECT a.attendance_id, e.employee_name, a.attendance_date, a.attendance_status
    FROM attendance a
    JOIN employee e ON a.employee_id = e.employee_id
    ORDER BY a.attendance_date DESC
");

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM attendance WHERE attendance_id = $id");
    header("Location: Attendance.php");
    exit();
}

$editMode = false;
$editEmployee = null;

if (isset($_GET['edit'])) {
    $editId = intval($_GET['edit']);
    $editQuery = $conn->query("SELECT * FROM attendance WHERE attendance_id = $editId");
    $editEmployee = $editQuery->fetch_assoc();
    $editMode = true;
}

if (isset($_POST['update'])) {
    $id = intval($_POST['attendance_id']);
    $employee_id = intval($_POST['employee_id']);
    $date = $_POST['attendance_date'];
    $status = $_POST['attendance_status'];

    $stmt = $conn->prepare("UPDATE attendance SET employee_id=?, attendance_date=?, attendance_status=? WHERE attendance_id=?");
    $stmt->bind_param("issi", $employee_id, $date, $status, $id);
    $stmt->execute();

    header("Location: attendance.php");
    exit();
}

// retrieve each employee record in attendance
$employee_attendance = "
    SELECT 
        e.employee_id,
        e.employee_name,
        SUM(CASE WHEN a.attendance_status = 'Present' THEN 1 ELSE 0 END) AS present_count,
        SUM(CASE WHEN a.attendance_status = 'Absent' THEN 1 ELSE 0 END) AS absent_count,
        SUM(CASE WHEN a.attendance_status = 'Late' THEN 1 ELSE 0 END) AS late_count
    FROM employee e
    LEFT JOIN attendance a ON e.employee_id = a.employee_id
    GROUP BY e.employee_id, e.employee_name
    ORDER BY e.employee_name
";
$attend_result = $conn->query($employee_attendance);

$month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');

// also retrieve each employee record but in selected month 
$monthly_report = "
    SELECT 
        e.employee_name,
        DATE_FORMAT(attendance_date, '%Y-%m') AS month, 
        COUNT(*) AS total_days,
        COUNT(CASE WHEN attendance_status = 'Present' THEN 1 END) AS present_days,
        COUNT(CASE WHEN attendance_status = 'Absent' THEN 1 END) AS absent_days,
        COUNT(CASE WHEN attendance_status = 'Late' THEN 1 END) AS late_days
    FROM attendance a
    JOIN employee e ON a.employee_id = e.employee_id # to retrieve employee name not employee id 
    WHERE DATE_FORMAT(attendance_date, '%Y-%m') = ?
    GROUP BY e.employee_name, DATE_FORMAT(a.attendance_date, '%Y-%m')
    ORDER BY e.employee_name
";

$report = $conn->prepare($monthly_report);
$report->bind_param("s", $month);
$report->execute();
$report_result = $report->get_result();
?>
