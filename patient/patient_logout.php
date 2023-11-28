<?php
session_start();
if(isset($_SESSION['patient']) && isset($_SESSION['patient_id'])){
    unset($_SESSION['patient']);
    unset($_SESSION['patient_id']);
    header("location:../patient-login.php");
}
?>