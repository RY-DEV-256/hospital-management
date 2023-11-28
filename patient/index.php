<?php
session_start();
$page = $_REQUEST['page'] ?? 'dashboard';

include("../parts/db-con.php");
if (!isset($_SESSION['patient']) && !isset($_SESSION['patient_id'])) {
    header("location:../index.php");
    exit();
} else {
    $email = $_SESSION['patient'];
    $sql = $connection->query("SELECT * FROM patients WHERE email = '$email'");
    while ($row = $sql->fetch_assoc()) {
        $patient_id = $row['patient_id'];
        $gender = $row['gender'];
        $phone = $row['phone'];
        $location = $row['location'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                    <li>
                        <button type="button" class="btn bg-danger text-white me-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fa fa-sign-out"></i>Logout
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="mt-5 mb-3">&nbsp;</div>
    <div class="container-fluid mt-5">
        <div class="col-md-12">
            <div class="row">
                <!-- modal for logout  -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Logout Confirmation!</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-danger">
                                Are you sure you want to logout ?
                            </div>
                            <div class="modal-footer">
                                <form action="patient_logout.php" method="post">
                                    <button type="submit" class="btn btn-primary">Yes</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="list-group" id="myTab">
                        <a class="list-group-item list-group-item-action bg-primary text-white" href="index.php?page=dashboard">Dashboard</a>
                        <a class="list-group-item list-group-item-action bg-primary text-white" href="index.php?page=book_appointment">Book Appointment</a>
                        <a class="list-group-item list-group-item-action bg-primary text-white" href="index.php?page=booked_appointment">Booked Appointment</a>
                        <a class="list-group-item list-group-item-action bg-primary text-white" href="index.php?page=upcoming_appointment">Upcomming Appointment</a>
                        <a class="list-group-item list-group-item-action bg-primary text-white" href="index.php?page=cancelled_appointment">Cancelled Appointment</a>
                        <!-- <a class="list-group-item list-group-item-action bg-primary text-white" href="index.php?page=replies">Replies</a> -->
                        <a class="list-group-item list-group-item-action bg-primary text-white" href="index.php?page=appointment_history">Appointment History</a>
                        <a class="list-group-item list-group-item-action bg-primary text-white" href="index.php?page=prescriptions">Prescriptions</a>
                        <a class="list-group-item list-group-item-action bg-primary text-white" href="index.php?page=profile">Profile</a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <?php
                                if ($page == 'dashboard') {
                                ?>
                                    <div class="container-fluid">
                                        <h5>Patient Dashboard</h5>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3 p-5 mb-2 me-3 bg-primary rounded shadow-lg">
                                                    <h5 class="text-center text-white">Upcomming Appointments</h5>
                                                    <?php
                                                    $booked_appointment = $connection->query("SELECT * FROM appointments WHERE patient_id = '$patient_id' AND doctor_reply != 'Pending....' AND `status` = 'Pending....'");
                                                    $row_booked = $booked_appointment->num_rows;
                                                    ?>
                                                    <a href="index.php?page=booked_appointment" class="nav-link">
                                                        <p class="text-center text-white" style="font-size:2rem;"><?= $row_booked; ?></p>
                                                    </a>
                                                </div>
                                                <div class="col-md-3 p-5 mb-2 me-3 bg-warning rounded shadow-lg">
                                                    <h5 class="text-center text-white">Booked Appointments</h5>
                                                    <?php
                                                    $booked_appointment = $connection->query("SELECT * FROM appointments WHERE patient_id = '$patient_id' AND doctor_reply = 'Pending....'");
                                                    $row_booked = $booked_appointment->num_rows;
                                                    ?>
                                                    <a href="index.php?page=booked_appointment" class="nav-link">
                                                        <p class="text-center text-white" style="font-size:2rem;"><?= $row_booked; ?></p>
                                                    </a>
                                                </div>
                                                <div class="col-md-3 p-5 mb-2 me-3 bg-danger rounded shadow-lg">
                                                    <h5 class="text-center text-white">Cancelled Appointments</h5>
                                                    <?php
                                                    $booked_appointment = $connection->query("SELECT * FROM appointments WHERE patient_id = '$patient_id' AND `status` = 'Cancelled'");
                                                    $row_booked = $booked_appointment->num_rows;
                                                    ?>
                                                    <a href="index.php?page=booked_appointment" class="nav-link">
                                                        <p class="text-center text-white" style="font-size:2rem;"><?= $row_booked; ?></p>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($page == 'book_appointment') {
                                ?>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5>Book Appointment</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <?php

                                                if (isset($_POST['book_appointment'])) {
                                                    $patient_id = $_POST['id'];
                                                    $doctor = $_POST['doctor'];
                                                    $consultancy = $_POST['consultancy'];
                                                    $date = $_POST['date'];
                                                    $time = $_POST['time'];
                                                    $reason = $_POST['reason'];

                                                    $error = array();
                                                    if (empty($date)) {
                                                        $error['error'] = 'Set Appointment Date !';
                                                    } else if (empty($time)) {
                                                        $error['error'] = "Select Time !";
                                                    } else if (empty($reason)) {
                                                        $error['error'] = 'Enter Appointment Reason !';
                                                    } else {
                                                        $book = $connection->query("INSERT INTO appointments (patient_id,doctor_id,`date`,`time`,`message`,consultancy_fee, doctor_reply,`status`) VALUES('$patient_id','$doctor','$date','$time','$reason','$consultancy','Pending....','Pending....')");
                                                        if ($book) {
                                                            $_SESSION['booked']  = "Booked Successfully";
                                                        }
                                                    }
                                                }
                                                ?>
                                                <form method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded">
                                                    <input type="hidden" name="id" value="<?= $patient_id; ?>">
                                                    <h4 class="text-center mt-2 mb-3">Book an Appointment</h4>

                                                    <div class="form-group my-2">
                                                        <label for="doctor" class="form-label">Select Doctor</label>
                                                        <select name="doctor" id="doctor" class="form-control">
                                                            <?php
                                                            $get_doctor = $connection->query("SELECT * FROM doctors");
                                                            while ($row_doctor = $get_doctor->fetch_array()) {
                                                            ?>
                                                                <option value="<?= $row_doctor['doctor_id']; ?>">Dr <?= $row_doctor['first_name']; ?> <?= $row_doctor['last_name']; ?>, <?= $row_doctor['specialization']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <label for="consultancy" class="form-label">Consultancy Fee(UGX)</label>
                                                        <input type="number" disabled id="consultancy" value="10000" class="form-control">
                                                        <input type="hidden" name="consultancy" value="10000" class="form-control">
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <label for="date" class="form-label">Appointment Date</label>
                                                        <input type="date" name="date" id="date" value="<?php if (isset($_POST['date'])) echo $_POST['date'];  ?>" class="form-control">
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <label for="time" class="form-label">Select Appointment Time</label>
                                                        <select name="time" id="time" class="form-control">

                                                            <option value="08:00 AM">08:00 AM</option>
                                                            <option value="10:00 AM">10:00 AM</option>
                                                            <option value="12:00 PM">12:00 PM</option>
                                                            <option value="02:00 PM">02:00 PM</option>
                                                            <option value="04:00 PM">04:00 PM</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <label for="reason" class="form-label">Message</label>
                                                        <input type="text" name="reason" id="reason" autocomplete="off" class="form-control">
                                                    </div>
                                                    <div class="form-group my-2">
                                                        <input type="submit" name="book_appointment" value="Book" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($page == 'booked_appointment') {
                                ?>
                                    <div class="container-fluid">
                                        <h5>Booked Appointments</h5>
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Doctor Name</th>
                                                    <th>Message</th>
                                                    <th>Doctor' reply</th>
                                                    <th>Action</th>
                                                </tr>
                                                <?php
                                                $i = 1;
                                                $appointment = $connection->query("SELECT ap.status, ap.consultancy_fee, ap.appointment_id, ap.date, ap.time, ap.booked_date, ap.message, ap.doctor_reply, do.first_name, do.last_name, do.specialization, do.phone_number FROM appointments ap INNER JOIN doctors do ON ap.doctor_id = do.doctor_id WHERE ap.patient_id = '$patient_id' AND ap.status = 'Pending....'");
                                                if ($appointment->num_rows < 1) {
                                                ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">No Booked Appointment !</td>
                                                    </tr>
                                            </table>
                                        <?php
                                                }
                                                foreach ($appointment as $index => $row) {
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                                <td><?= $row['message']; ?></td>
                                                <td><?= $row['doctor_reply']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#viewAppointment<?= $index; ?>">View</button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAppointment<?= $index; ?>">Cancel</button>
                                                </td>
                                                <!-- modal for canceling appointment  -->
                                                <div class="modal fade" id="deleteAppointment<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">Cancel Appointment</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>Are you sure you want to cancel this Appointment ?</h6>
                                                                <?php
                                                                if (isset($_POST['cancel_appointment'])) {
                                                                    $appointment_id = $_POST['id'];
                                                                    $reason = $_POST['reason'];
                                                                    $name = $_POST['name'];
                                                                    $delete = $connection->query("UPDATE appointments SET `status` = 'Cancelled', reason_for_cancelling = '$reason', cancelled_by = '$name' WHERE appointment_id = '$appointment_id'");
                                                                    if ($delete) {
                                                                        $_SESSION['cancel_appointment'] = "Cancelled Successfully";
                                                                    }
                                                                }
                                                                ?>
                                                                <form method="post">
                                                                    <label for="reason" class="form-label">Enter Reason :</label>
                                                                    <input type="text" name="reason" class="form-control" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="name" value="<?= $first_name; ?> <?= $last_name; ?>">
                                                                <input type="hidden" name="id" value="<?= $row['appointment_id']; ?>">
                                                                <button type="submit" name="cancel_appointment" class="btn btn-primary">Yes</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="viewAppointment<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Appointment Details</h1>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <h5 class="text-success">Doctor : <span class="text-dark">Dr. <?= $row['first_name']; ?> <?= $row['last_name']; ?></span></h5>
                                                                    <h5 class="text-success">Specialization : <span class="text-dark"><?= $row['specialization']; ?></span></h5>
                                                                    <h5 class="text-success">Doctor' Number : <span class="text-dark"><?= $row['phone_number']; ?></span></h5>
                                                                    <h5 class="text-success">Message : <span class="text-dark"><?= $row['message']; ?></span></h5>
                                                                    <h5 class="text-success">Doctor' Reply : <span class="text-dark"><?= $row['doctor_reply']; ?></span></h5>
                                                                    <h5 class="text-success">Status : <span class="text-dark"><?= $row['status']; ?></span></h5>
                                                                    <h5 class="text-success">Appointment Date : <span class="text-dark"><?= $row['date']; ?></span></h5>
                                                                    <h5 class="text-success">Appointment Time : <span class="text-dark"><?= $row['time']; ?></span></h5>
                                                                    <h5 class="text-success">Consultancy Fee : <span class="text-dark">UGX <?= $row['consultancy_fee']; ?></span></h5>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        <?php
                                                }

                                        ?>

                                        </table>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($page == 'upcoming_appointment') {
                                ?>
                                    <div class="container-fluid">
                                        <h5>Upcomming Appointments</h5>
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Doctor Name</th>
                                                    <th>Message</th>
                                                    <th>Doctor' reply</th>
                                                    <th>Action</th>
                                                </tr>
                                                <?php
                                                $i = 1;
                                                $appointment = $connection->query("SELECT ap.status, ap.consultancy_fee, ap.appointment_id, ap.date, ap.time, ap.booked_date, ap.message, ap.doctor_reply, do.first_name, do.last_name, do.specialization, do.phone_number FROM appointments ap INNER JOIN doctors do ON ap.doctor_id = do.doctor_id WHERE ap.patient_id = '$patient_id' AND doctor_reply != 'Pending....' AND `status` ='Pending....'");
                                                if ($appointment->num_rows < 1) {
                                                ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">No Upcomming Appointment !</td>
                                                    </tr>
                                            </table>
                                        <?php
                                                }
                                                foreach ($appointment as $index => $row) {
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                                <td><?= $row['message']; ?></td>
                                                <td><?= $row['doctor_reply']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#viewAppointment<?= $index; ?>">View</button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAppointment<?= $index; ?>">Cancel</button>
                                                </td>
                                                <!-- modal for canceling appointment  -->
                                                <div class="modal fade" id="deleteAppointment<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">Cancel Appointment</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>Are you sure you want to cancel this Appointment ?</h6>
                                                                <?php
                                                                if (isset($_POST['cancel_appointment'])) {
                                                                    $appointment_id = $_POST['id'];
                                                                    $reason = $_POST['reason'];
                                                                    $name = $_POST['name'];
                                                                    $delete = $connection->query("UPDATE appointments SET `status` = 'Cancelled', reason_for_cancelling = '$reason', cancelled_by = '$name' WHERE appointment_id = '$appointment_id'");
                                                                    if ($delete) {
                                                                        $_SESSION['cancel_appointment'] = "Cancelled Successfully";
                                                                    }
                                                                }
                                                                ?>
                                                                <form method="post">
                                                                    <label for="reason" class="form-label">Enter Reason :</label>
                                                                    <input type="text" name="reason" class="form-control" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="name" value="<?= $first_name; ?> <?= $last_name; ?>">
                                                                <input type="hidden" name="id" value="<?= $row['appointment_id']; ?>">
                                                                <button type="submit" name="cancel_appointment" class="btn btn-primary">Yes</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- modal for viewing upcoming_appointment  -->
                                                <div class="modal fade" id="viewAppointment<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upcomming Appointment Details</h1>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <h5 class="text-success">Doctor : <span class="text-dark">Dr. <?= $row['first_name']; ?> <?= $row['last_name']; ?></span></h5>
                                                                    <h5 class="text-success">Specialization : <span class="text-dark"><?= $row['specialization']; ?></span></h5>
                                                                    <h5 class="text-success">Doctor' Number : <span class="text-dark"><?= $row['phone_number']; ?></span></h5>
                                                                    <h5 class="text-success">Message : <span class="text-dark"><?= $row['message']; ?></span></h5>
                                                                    <h5 class="text-success">Doctor' Reply : <span class="text-dark"><?= $row['doctor_reply']; ?></span></h5>
                                                                    <h5 class="text-success">Status : <span class="text-dark"><?= $row['status']; ?></span></h5>
                                                                    <h5 class="text-success">Appointment Date : <span class="text-dark"><?= $row['date']; ?></span></h5>
                                                                    <h5 class="text-success">Appointment Time : <span class="text-dark"><?= $row['time']; ?></span></h5>
                                                                    <h5 class="text-success">Consultancy Fee : <span class="text-dark">UGX <?= $row['consultancy_fee']; ?></span></h5>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        <?php
                                                }

                                        ?>

                                        </table>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($page == 'cancelled_appointment') {
                                ?>
                                    <div class="container-fluid">
                                        <h5>Cancelled Appointments</h5>
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Doctor Name</th>
                                                    <th>Message</th>
                                                    <th>Current Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                <?php
                                                $i = 1;
                                                $appointment = $connection->query("SELECT ap.status, ap.consultancy_fee, ap.appointment_id, ap.date, ap.time, ap.booked_date, ap.message, ap.doctor_reply, do.first_name, do.last_name, do.specialization, do.phone_number FROM appointments ap INNER JOIN doctors do ON ap.doctor_id = do.doctor_id WHERE ap.patient_id = '$patient_id' AND  `status` ='Cancelled'");
                                                if ($appointment->num_rows < 1) {
                                                ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">No Cancelled Appointment !</td>
                                                    </tr>
                                            </table>
                                        <?php
                                                }
                                                foreach ($appointment as $index => $row) {
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                                <td><?= $row['message']; ?></td>
                                                <td><?= $row['status']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#viewAppointment<?= $index; ?>">View</button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAppointment<?= $index; ?>">Cancel</button>
                                                </td>
                                                <!-- modal for canceling appointment  -->
                                                <div class="modal fade" id="deleteAppointment<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">Cancel Appointment</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>Are you sure you want to cancel this Appointment ?</h6>
                                                                <?php
                                                                if (isset($_POST['cancel_appointment'])) {
                                                                    $appointment_id = $_POST['id'];
                                                                    $reason = $_POST['reason'];
                                                                    $name = $_POST['name'];
                                                                    $delete = $connection->query("UPDATE appointments SET `status` = 'Cancelled', reason_for_cancelling = '$reason', cancelled_by = '$name' WHERE appointment_id = '$appointment_id'");
                                                                    if ($delete) {
                                                                        $_SESSION['cancel_appointment'] = "Cancelled Successfully";
                                                                    }
                                                                }
                                                                ?>
                                                                <form method="post">
                                                                    <label for="reason" class="form-label">Enter Reason :</label>
                                                                    <input type="text" name="reason" class="form-control" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="name" value="<?= $first_name; ?> <?= $last_name; ?>">
                                                                <input type="hidden" name="id" value="<?= $row['appointment_id']; ?>">
                                                                <button type="submit" name="cancel_appointment" class="btn btn-primary">Yes</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- modal for viewing upcoming_appointment  -->
                                                <div class="modal fade" id="viewAppointment<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upcomming Appointment Details</h1>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <h5 class="text-success">Doctor : <span class="text-dark">Dr. <?= $row['first_name']; ?> <?= $row['last_name']; ?></span></h5>
                                                                    <h5 class="text-success">Specialization : <span class="text-dark"><?= $row['specialization']; ?></span></h5>
                                                                    <h5 class="text-success">Doctor' Number : <span class="text-dark"><?= $row['phone_number']; ?></span></h5>
                                                                    <h5 class="text-success">Message : <span class="text-dark"><?= $row['message']; ?></span></h5>
                                                                    <h5 class="text-success">Doctor' Reply : <span class="text-dark"><?= $row['doctor_reply']; ?></span></h5>
                                                                    <h5 class="text-success">Status : <span class="text-dark"><?= $row['status']; ?></span></h5>
                                                                    <h5 class="text-success">Appointment Date : <span class="text-dark"><?= $row['date']; ?></span></h5>
                                                                    <h5 class="text-success">Appointment Time : <span class="text-dark"><?= $row['time']; ?></span></h5>
                                                                    <h5 class="text-success">Consultancy Fee : <span class="text-dark">UGX <?= $row['consultancy_fee']; ?></span></h5>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        <?php
                                                }

                                        ?>

                                        </table>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($page == 'appointment_history') {
                                ?>
                                    <div class="container-fluid">
                                        <h5>Appointment History</h5>
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Doctor Name</th>
                                                    <th>Appointment Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                <?php
                                                $i = 1;
                                                $appointment = $connection->query("SELECT ap.status, ap.consultancy_fee, ap.appointment_id, ap.date, ap.time, ap.booked_date, ap.message, ap.doctor_reply, do.first_name, do.last_name, do.specialization, do.phone_number FROM appointments ap INNER JOIN doctors do ON ap.doctor_id = do.doctor_id WHERE ap.patient_id = '$patient_id' AND `status` = 'Done'");
                                                if ($appointment->num_rows < 1) {
                                                ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">No  Appointment History Yet !</td>
                                                    </tr>
                                            </table>
                                        <?php
                                                }
                                                foreach ($appointment as $index => $row) {
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                                <td><?= $row['date']; ?></td>
                                                <td><?= $row['status']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#viewAppointment<?= $index; ?>">View</button>
                                                </td>

                                                <div class="modal fade" id="viewAppointment<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Appointment Details</h1>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <h5 class="text-success">Doctor : <span class="text-dark">Dr. <?= $row['first_name']; ?> <?= $row['last_name']; ?></span></h5>
                                                                    <h5 class="text-success">Specialization : <span class="text-dark"><?= $row['specialization']; ?></span></h5>
                                                                    <h5 class="text-success">Doctor' Number : <span class="text-dark"><?= $row['phone_number']; ?></span></h5>
                                                                    <h5 class="text-success">Message : <span class="text-dark"><?= $row['message']; ?></span></h5>
                                                                    <h5 class="text-success">Doctor' Reply : <span class="text-dark"><?= $row['doctor_reply']; ?></span></h5>
                                                                    <h5 class="text-success">Status : <span class="text-dark"><?= $row['status']; ?></span></h5>
                                                                    <h5 class="text-success">Appointment Date : <span class="text-dark"><?= $row['date']; ?></span></h5>
                                                                    <h5 class="text-success">Appointment Time : <span class="text-dark"><?= $row['time']; ?></span></h5>
                                                                    <h5 class="text-success">Consultancy Fee : <span class="text-dark">UGX <?= $row['consultancy_fee']; ?></span></h5>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        <?php
                                                }

                                        ?>

                                        </table>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($page == 'prescriptions') {
                                ?>
                                    <div class="col-md-12">
                                        <h5>Prescriptions</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Doctor Name</th>
                                                        <th>Prescription Date/Time</th>
                                                        <th>Diseases</th>
                                                        <th>Medication</th>
                                                        <th>Dosage</th>
                                                        <th>Instructions</th>
                                                        <th>Bill Payment</th>
                                                    </tr>
                                                    <?php
                                                    $i=1;
                                                    $get_prescriptions = $connection->query("SELECT * FROM prescriptions pr INNER JOIN doctors do ON pr.doctor_id = do.doctor_id WHERE patient_id = '$patient_id'");
                                                    if ($get_prescriptions->num_rows < 1) {
                                                    ?>
                                                        <tr>
                                                            <td colspan="8" class="text-center">No Prescriptions Yet</td>
                                                        </tr>
                                                </table>
                                            <?php
                                                    }
                                                    while ($row = $get_prescriptions->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td>Dr. <?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                                    <td><?= $row['date']; ?></td>
                                                    <td><?= $row['diseases']; ?></td>
                                                    <td><?= $row['medication']; ?></td>
                                                    <td><?= $row['dosage']; ?></td>
                                                    <td><?= $row['instructions']; ?></td>
                                                    <td><?= $row['bill']; ?></td>
                                                </tr>
                                            <?php
                                                    }
                                            ?>

                                            </table>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                if ($page == 'profile') {
                                ?>
                                    <div class="container-fluid">
                                        <h5>My Profile</h5>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                    <div class="shadow-lg bg-body-tertiary p-3">
                                                        <?php
                                                        $get_patient_info = $connection->query("SELECT * FROM patients WHERE patient_id = '$patient_id'");
                                                        $row = $get_patient_info->fetch_assoc();
                                                        ?>
                                                        <div class="text-center">
                                                            <img src="../assets/img/<?= $row['profile_image']; ?>" style="width:150px;height:150px;border-radius:50%;">
                                                        </div>
                                                        <div class="my-2 mt-5">
                                                            <h5><span class="text-primary">First Name :</span>&nbsp;&nbsp;<?= $row['first_name']; ?></h5>
                                                            <h5><span class="text-primary">Last Name :</span>&nbsp;&nbsp;<?= $row['last_name']; ?></h5>
                                                            <h5><span class="text-primary">Email :</span>&nbsp;&nbsp;<?= $row['email']; ?></h5>
                                                            <h5><span class="text-primary">Phone Number :</span>&nbsp;&nbsp;<?= $row['phone']; ?></h5>
                                                            <h5><span class="text-primary">Location :</span>&nbsp;&nbsp;<?= $row['location']; ?></h5>
                                                            <h5><span class="text-primary">Date of Birth :</span>&nbsp;&nbsp;<?= $row['date_of_birth']; ?></h5>
                                                            <h5><span class="text-primary">Gender :</span>&nbsp;&nbsp;<?= $row['gender']; ?></h5>
                                                        </div>
                                                        <div class="my-3">
                                                            <a href="index.php?page=edit_profile" class="btn btn-primary">Edit Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($page == 'edit_profile') {
                                ?>
                                    <div class="container-fluid">
                                        <h5>Edit Profile</h5>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                    <?php
                                                    if (isset($_POST['edit_profile'])) {
                                                        $id = $_POST['id'];
                                                        $phone = $_POST['phone'];
                                                        $profile_image = $_FILES['image']['name'];
                                                        $location = $_POST['location'];

                                                        $error = array();

                                                        if (empty($profile_image)) {
                                                            $error['error'] = 'Choose Image !';
                                                        } else if (empty($phone)) {
                                                            $error['error'] = 'Enter Phone Number !';
                                                        } else if (empty($location)) {
                                                            $error['error'] = 'Enter Location !';
                                                        } else {
                                                            $update_profile = $connection->query("UPDATE patients SET profile_image = '$profile_image', phone = '$phone',  `location` = '$location' WHERE patient_id = '$id'");
                                                            if ($update_profile) {
                                                                $_SESSION['update'] = "Updated Successfully";
                                                                move_uploaded_file($_FILES['image']['tmp_name'], "../assets/img/$profile_image");
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <form method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded" enctype="multipart/form-data">
                                                        <h5 class="text-center my-3">Edit Profile</h5>
                                                        <div class="my-2">
                                                            <input type="hidden" name="id" value="<?= $patient_id; ?>">
                                                        </div>
                                                        <div class="form-group my-2">
                                                            <label class="form-label" for="profile">Profile Picture</label>
                                                            <input type="file" name="image" id="profile" class="form-control">
                                                        </div>
                                                        <div class="form-group my-2">
                                                            <label class="form-label" for="phone">Phone Number</label>
                                                            <input type="text" name="phone" value="<?= $phone; ?>" class="form-control">
                                                        </div>

                                                        <div class="form-group my-2">
                                                            <label class="form-label" for="location">Location</label>
                                                            <input type="text" name="location" value="<?= $location; ?>" id="location" class="form-control">
                                                        </div>
                                                        <div class="form-group my-2">
                                                            <input type="submit" value="Edit" name="edit_profile" class="btn btn-primary">
                                                            <a href="index.php?page=profile" class="btn btn-secondary">Back</a>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
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
    <?php
    if (isset($_SESSION['booked'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['booked']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=booked_appointment";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['booked']);
    }
    ?>
    <?php
    if (isset($_SESSION['update'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['update']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=profile";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['update']);
    }
    ?>
    <?php
    if (isset($_SESSION['cancel_appointment'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['cancel_appointment']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=booked_appointment";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['cancel_appointment']);
    }
    ?>
    <?php
    if (isset($error["error"])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('<?= $error["error"]; ?>');
        </script>
    <?php
    }
    ?>

</body>

</html>