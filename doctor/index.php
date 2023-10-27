<?php
session_start();
$page = $_REQUEST['page'] ?? 'dashboard';

include("../parts/db-con.php");
if (!isset($_SESSION['doctor'])) {
    header("location:../index.php");
    exit();
} else {
    $username = $_SESSION['doctor'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
    <div class="container-main">
        <div class="left-side bg-primary">
            <div class="welcome">
                <!-- <h5 class="text-dark text-center">Welcome to Dashboard</h5> -->
            </div>
            <div class="list-group">
                <a href="index.php?page=dashboard" class="list-group-item list-group-item-action bg-primary  text-left text-white">Dashboard</a>
                <a href="index.php?page=upcomming_appointments" class="list-group-item list-group-item-action bg-primary  text-left text-white">Upcomming Appointments</a>
                <a href="index.php?page=appointments" class="list-group-item list-group-item-action bg-primary  text-left text-white">Appointments History</a>
                <a href="index.php?page=patients" class="list-group-item list-group-item-action bg-primary  text-left text-white">My Patients</a>
                <a href="index.php?page=medications" class="list-group-item list-group-item-action bg-primary  text-left text-white">Current Medications</a>
                <a href="index.php?page=allergies" class="list-group-item list-group-item-action bg-primary  text-left text-white">Allergies and Adverse Reactions</a>
                <!-- <a href="index.php?page=care_plan" class="list-group-item list-group-item-action bg-primary  text-left text-white">Care Plan</a> -->
                <a href="index.php?page=daily_tasks" class="list-group-item list-group-item-action bg-primary  text-left text-white">Daily Tasks</a>
                <a href="index.php?page=medical_reports" class="list-group-item list-group-item-action bg-primary  text-left text-white">Medical Reports</a>
                <a href="index.php?page=department_information" class="list-group-item list-group-item-action bg-primary  text-left text-white">Department Information</a>
                <a href="index.php?page=lab_test_result" class="list-group-item list-group-item-action bg-primary  text-left text-white">Lab Test Results</a>
                <!-- <a href="index.php?page=chats" class="list-group-item list-group-item-action bg-primary  text-left text-white">Chats</a> -->
            </div>
        </div>
        <div class="right-side">
            <nav class="navbar navbar-expand-sm bg-white top-navbar-hd">
                <div class="top-navbar-content p-3">
                    <div class="nav-page text-primary mt-1"><?php
                                                            if ($page == 'dashboard') {
                                                                echo "Dashboard";
                                                            } else if ($page == 'upcomming_appointments') {
                                                                echo "Upcoming Appointments";
                                                            } else if ($page == 'appointments') {
                                                                echo "Appointments";
                                                            } else if ($page == 'patients') {
                                                                echo "My Patients";
                                                            } else if ($page == 'medications') {
                                                                echo "Current Medications";
                                                            } else if ($page == 'allergies') {
                                                                echo "Allergies and Adverse Reactions";
                                                            } else if ($page == 'chats') {
                                                                echo "Chats";
                                                            } else if ($page == 'medical_reports') {
                                                                echo "Medical Reports";
                                                            } else if ($page == 'daily_tasks') {
                                                                echo "Daily Tasks";
                                                            } else if ($page == 'notifications') {
                                                                echo "Notifications";
                                                            } else if ($page == 'department_information') {
                                                                echo "Department Information";
                                                            } else if ($page == 'lab_test_result') {
                                                                echo "Laboratory Test Results";
                                                            } else if ($page == 'myprofile') {
                                                                echo "My Profile";
                                                            }
                                                            ?></div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navLinks"><span><i class="navbar-toggler-icon"></i></span></button>
                    <div class="collapse navbar-collapse" id="navLinks">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item me-3">
                                <a href="index.php?page=notifications" class="nav-link text-primary"><i class="fa fa-bell"><sup class="text-danger">1</sup></i></a>
                            </li>
                            <li class="nav-item me-3">
                                <a href="index.php?page=chats" class="nav-link text-primary">Chats <sup class="text-danger">1</sup></a>
                            </li>
                            <li class="nav-item me-3 profile" style="border-left:2px solid black;border-right:2px solid black;padding: 0px 5px;">
                                <a href="index.php?page=myprofile" class="nav-link">
                                    <span class="text-primary"><?= $username; ?>
                                        <img src="../assets/img/0.jpeg" style="width: 30px;height:30px;border:1px solid black;border-radius:50%;padding:2px;">
                                    </span>
                                </a>

                            </li>
                            
                            <li>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fa fa-sign-out"></i>Logout
                                </button>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="main-content">

                <!-- modal for logout  -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Logout !</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to logout ?
                            </div>
                            <div class="modal-footer">
                                <form action="doctor_logout.php" method="post">
                                    <button type="submit" class="btn btn-primary">Okay</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($page == 'dashboard') {
                    echo 'Dash';
                }
                if ($page == 'upcomming_appointments') {
                ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Patient Name</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <th>Current Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php
                }
                if ($page == 'appointments') {
                ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Patient Name</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <th>Current Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php
                }
                if ($page == 'patients') {
                ?>
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Gender</th>
                                <th>Phone Number</th>
                                <th>Location</th>
                                <th>Diseases</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>