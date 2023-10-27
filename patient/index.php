<?php
session_start();
$page = $_REQUEST['page'] ?? 'dashboard';

include("../parts/db-con.php");
if (!isset($_SESSION['patient'])) {
    header("location:../index.php");
    exit();
} else {
    $email = $_SESSION['patient'];
    $sql = $connection->query("SELECT * FROM patients WHERE email = '$email'");
    while ($row = $sql->fetch_assoc()) {
        $gender = $row['gender'];
        $first_name = $row['first_name'];
        if ($gender == 'Male') {
            $gender = 'Mr.';
        } else {
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
    <link rel="stylesheet" href="../assets/alertify/alertify.min.css">
    <link rel="stylesheet" href="../assets/alertify/default.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
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
                    <li class="nav-item dropdown me-5">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../assets/img/0.jpeg" style="width: 30px;height:30px;border:1px solid black;border-radius:50%;padding:2px;">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?page=profile">Profile</a></li>
                            <li><a class="dropdown-item" href="index.php?page=settings">Settings</a></li>
                            <li><a class="dropdown-item" href="index.php?page=notifications">Notifications</a></li>
                        </ul>
                    </li>
                    <li class="nav-item me-5">
                        <a href="patient_logout.php" class="nav-link text-dark">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link text-dark"></a>
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
                    <div class="list-group" id="myTab">
                        <a class="list-group-item list-group-item-action" href="index.php?page=dashboard">Dashboard</a>
                        <a class="list-group-item list-group-item-action" href="index.php?page=book_appointment">Book Appointment</a>
                        <a class="list-group-item list-group-item-action" href="index.php?page=appointment_history">Appointment History</a>
                        <a class="list-group-item list-group-item-action" href="index.php?page=prescriptions">Prescriptions</a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <?php
                                if ($page == 'dashboard') {
                                    echo 'Welcome to dashboard';
                                    ?>
                                    
                                    <?php
                                }
                                if ($page == 'book_appointment') {
                                    ?>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <form method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded">
                                                    <h4 class="text-center mt-2 mb-3">Create an Appointment</h4>
                                                    <div class="form-group my-2">
                                                        <label for="specialization" class="form-label">Specialization</label>
                                                        <select name="specialization" id="specialization" class="form-control">
                                                            <option value="">General</option>
                                                            <option value="">Dentist</option>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <label for="doctor" class="form-label">Doctor</label>
                                                        <select name="doctor" id="doctor" class="form-control">
                                                            <option value="">Select Doctor</option>
                                                            <option value="">Adam</option>
                                                            <option value="">Richard</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <label for="consultancy" class="form-label">Consultancy Fee</label>
                                                        <input type="number" disabled id="consultancy" value="230" class="form-control">
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <label for="date" class="form-label">Appointment Date</label>
                                                        <input type="date"id="date" class="form-control">
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <label for="time" class="form-label">Appointment Time</label>
                                                        <select name="time" id="time" class="form-control">
                                                            <option value="">Select time</option>
                                                            <option value="">08:00 AM</option>
                                                            <option value="">10:00 AM</option>
                                                            <option value="">12:00 PM</option>
                                                            <option value="">02:00 PM</option>
                                                            <option value="">04:00 PM</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <input type="submit" name="appointment" value="Create" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                if ($page == 'appointment_history') {
                                    ?>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Doctor Name</th>
                                                    <th>Consultancy Fee</th>
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
                                if ($page == 'prescriptions') {
                                    ?>
                                     <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Doctor Name</th>
                                                    <th>Appointment ID</th>
                                                    <th>Appointment Date</th>
                                                    
                                                    <th>Diseases</th>
                                                    <th>Allergies</th>
                                                    <th>Prescriptions</th>
                                                    <th>Bill Payment</th>
                                                </tr>
                                                <tr>
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
                                        </div>
                                    </div>

                                    <?php
                                }
                                if ($page == 'profile') {
                                }
                                if ($page == 'settings') {
                                }
                                if ($page == 'prescription') {
                                }
                                ?>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/alertify/alertify.min.js"></script>
</body>

</html>