<?php
session_start();
include("parts/db-con.php");
if(!isset($_SESSION['patient'])){
    header("location:index.php");
    exit();
}else{
    $email = $_SESSION['patient'];
    $sql = $connection->query("SELECT * FROM patients WHERE first_name = '$email'");
    while($row = $sql->fetch_assoc()){
        $gender = $row['gender'];
        $first_name = $row['first_name'];
        if($gender == 'Male'){
            $gender = 'Mr.';
        }else{
            $gender = 'Ms.';
        }
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="assets/alertify/alertify.min.css">
    <link rel="stylesheet" href="assets/alertify/default.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<style>
    * {
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
    }

    body {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
</style>

<body>
    <nav class="navbar navbar-expand-sm shadow mb-5 bg-body-tertiary fixed-top">
        <div class="container-fluid p-3 ">
            <a class="navbar-brand text-primary" href="index.php">Welcome <?= $gender; ?> <?= $first_name; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navLinks"><span><i class="navbar-toggler-icon"></i></span></button>
            <div class="collapse navbar-collapse justify-content-center" id="navLinks">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="#home" class="nav-link text-dark">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link text-dark"></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../assets/img/0.jpeg" style="width: 30px;height:30px;border:1px solid black;border-radius:50%;padding:2px;">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Notifications</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="mt-5 mb-3">&nbsp;</div>
    <div class="container-fluid mt-5">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active"  data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">Dashboard</a>
                        <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">Book Appointment</a>
                        <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">Appointment History</a>
                        <a class="list-group-item list-group-item-action"  data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings">Prescriptions</a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">

                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/alertify/alertify.min.js"></script>
</body>

</html>