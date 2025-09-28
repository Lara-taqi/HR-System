<?php
if (!isset($_SESSION['employee_id'])) {
     header("Location: ../views/authentication/login.php");
    exit;
}
?>
