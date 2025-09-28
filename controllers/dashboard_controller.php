<?php
$pending = "SELECT COUNT(*) AS pending_request FROM leaves WHERE leave_status='Pending'";#this line to retrieve the number of pending leave request
$result = $conn->query($pending);
$row = $result->fetch_assoc();

$other_request="SELECT COUNT(*) AS other_req FROM leaves WHERE leave_status IN ('Approved','Rejected')";#and this one to retrieve the remaining request 
$req_result=$conn->query($other_request);
$row_req=$req_result->fetch_assoc();

$sql = "SELECT d.department_name AS department, COUNT(e.employee_id) AS employee_count
        FROM department d
        LEFT JOIN employee e ON d.department_id = e.department_id #to retrieve the employee who assigend to specific department
        GROUP BY d.department_id";
$employee_result = $conn->query($sql);


$labels = "";
$data = "";
while ($employee_row = $employee_result->fetch_assoc()) {//chart to show the number of employee in each department 
    $labels .= "'" . $employee_row['department'] . "',";//retrieve department name 
    $data .= $employee_row['employee_count'] . ",";//retrieve amount of employee
}

$conn->close();
?>