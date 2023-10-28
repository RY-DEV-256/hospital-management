<?php
session_start();
    if(isset($_SESSION['doctor']) && isset($_SESSION['id'])){
        unset($_SESSION['doctor']);
        unset($_SESSION['id']);
        header("location:../index.php");
    }
?>