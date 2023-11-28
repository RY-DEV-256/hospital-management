<?php
session_start();
$page = $_REQUEST['page'] ?? 'dashboard';

include("../parts/db-con.php");
if (!isset($_SESSION['doctor']) && !isset($_SESSION['id'])) {
    header("location:../index.php");
    exit();
} else {
    $doc_id = $_SESSION["id"];
    $username = $_SESSION['doctor'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/alertify/alertify.min.css">
    <link rel="stylesheet" href="../assets/alertify/default.min.css">
    <link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container-main">
        <div class="left-side bg-primary">
            <div class="welcome"></div>
            <div class="list-group">
                <a href="index.php?page=dashboard" class="list-group-item list-group-item-action bg-primary  text-left text-white">Dashboard</a>
                <a href="index.php?page=appointments" class="list-group-item list-group-item-action bg-primary  text-left text-white">Booked Appointments</a>
                <a href="index.php?page=upcomming_appointments" class="list-group-item list-group-item-action bg-primary  text-left text-white">Upcomming Appointments</a>
                <a href="index.php?page=appointments_history" class="list-group-item list-group-item-action bg-primary  text-left text-white">Appointments History</a>
                <a href="index.php?page=cancelled_appointments" class="list-group-item list-group-item-action bg-primary  text-left text-white">Cancelled Appointments</a>
                <a href="index.php?page=inpatients" class="list-group-item list-group-item-action bg-primary  text-left text-white">Inpatients</a>
                <a href="index.php?page=prescriptions" class="list-group-item list-group-item-action bg-primary  text-left text-white">Prescriptions</a>
                <a href="index.php?page=outpatients" class="list-group-item list-group-item-action bg-primary  text-left text-white">Outpatients</a>
                <a href="index.php?page=daily_tasks" class="list-group-item list-group-item-action bg-primary  text-left text-white">Daily Tasks</a>
                <a href="index.php?page=medical_reports" class="list-group-item list-group-item-action bg-primary  text-left text-white">Medical Reports</a>
                <a href="index.php?page=laboratory" class="list-group-item list-group-item-action bg-primary  text-left text-white">Laboratory Test</a>
                <a href="index.php?page=lab_test_results" class="list-group-item list-group-item-action bg-primary  text-left text-white">Laboratory Test Results</a>
                <!-- <a href="index.php?page=chats" class="list-group-item list-group-item-action bg-primary  text-left text-white">Chats</a> -->
            </div>
        </div>
        <div class="right-side">
            <nav class="navbar navbar-expand-sm bg-white top-navbar-hd">
                <div class="top-navbar-content p-3">
                    <div class="nav-page text-primary mt-1"><?php
                                                            if ($page == 'dashboard') {
                                                                echo "Dashboard";
                                                            } else if ($page == 'appointments') {
                                                                echo "Booked Appointments";
                                                            } else if ($page == 'upcomming_appointments') {
                                                                echo "Upcomming Appointments";
                                                            } else if ($page == 'appointments_history') {
                                                                echo "Appointments History";
                                                            } else if ($page == 'inpatients') {
                                                                echo "Inpatients";
                                                            } else if ($page == 'outpatients') {
                                                                echo "Outpatients";
                                                            } else if ($page == 'cancelled_appointments') {
                                                                echo "Cancelled Appointments";
                                                            } else if ($page == 'add_prescriptions') {
                                                                echo "Add Prescriptions";
                                                            } else if ($page == 'prescriptions') {
                                                                echo "Prescriptions";
                                                            } else if ($page == 'chats') {
                                                                echo "Chats";
                                                            } else if ($page == 'medical_reports') {
                                                                echo "Medical Reports";
                                                            } else if ($page == 'daily_tasks') {
                                                                echo "Daily Tasks";
                                                            } else if ($page == 'notifications') {
                                                                echo "Notifications";
                                                            } else if ($page == 'admit_patient') {
                                                                echo "Admit Patient";
                                                            } else if ($page == 'laboratory') {
                                                                echo "Laboratory Test";
                                                            } else if ($page == 'lab_test_results') {
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
                                <a href="#" class="nav-link text-primary">Chats <sup class="text-danger">1</sup></a>
                            </li>
                            <li class="nav-item me-3 profile" style="border-left:2px solid black;border-right:2px solid black;padding: 0px 5px;">
                                <a href="index.php?page=myprofile" class="nav-link">
                                    <span class="text-primary"><?= $username; ?>
                                        <?php
                                        $get_profile_img = $connection->query("SELECT profile_image FROM doctors WHERE doctor_id = '$doc_id'");
                                        $profile_image = $get_profile_img->fetch_array();
                                        ?>
                                        <img src="../assets/img/<?= $profile_image['profile_image']; ?>" style="width: 30px;height:30px;border:1px solid black;border-radius:50%;padding:2px;">
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
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Logout Confirmation !</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-danger">
                                Are you sure you want to logout ?
                            </div>
                            <div class="modal-footer">
                                <form action="doctor_logout.php" method="post">
                                    <button type="submit" class="btn btn-primary">Yes</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($page == 'dashboard') {
                ?>
                    <div class="col-md-12">
                        <h5 class="text-primary">Welcome Dr. <?= $username; ?> to dashboard.</h5>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4 my-2">
                                    <div class="bg-primary rounded p-3 text-center text-white">
                                        <h5>Booked Appointments</h5>
                                        <?php
                                        $get_booked_a = $connection->query("SELECT * FROM appointments WHERE doctor_id = '$doc_id' AND doctor_reply='Pending....'");
                                        $booked_a = $get_booked_a->num_rows;
                                        ?>
                                        <a href="index.php?page=appointments" class="nav-link">
                                            <h1 class="my-2"><?= $booked_a; ?></h1>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2">
                                    <div class="bg-success rounded p-3 text-center text-white">
                                        <h5>Upcomming Appointments</h5>
                                        <?php
                                        $get_upcoming_a = $connection->query("SELECT * FROM appointments WHERE doctor_id = '$doc_id' AND doctor_reply !='Pending....'");
                                        $upcoming_a = $get_upcoming_a->num_rows;
                                        ?>
                                        <a href="index.php?page=upcomming_appointments" class="nav-link">
                                            <h1 class="my-2"><?= $upcoming_a; ?></h1>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2">
                                    <div class="bg-warning rounded p-3 text-center text-white">
                                        <h5>Inpatients</h5>
                                        <?php
                                        $get_inpatient = $connection->query("SELECT * FROM admissions WHERE doctor_id = '$doc_id' AND admission_status ='Inpatient'");
                                        $inpatient = $get_inpatient->num_rows;
                                        ?>
                                        <a href="index.php?page=inpatients" class="nav-link">
                                            <h1 class="my-2"><?= $inpatient; ?></h1>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 my-2">
                                    <div class="bg-success rounded p-3 text-center text-white">
                                        <h5>Outpatients</h5>
                                        <?php
                                        $get_outpatient = $connection->query("SELECT * FROM admissions WHERE doctor_id = '$doc_id' AND admission_status='Outpatient'");
                                        $outpatient = $get_outpatient->num_rows;
                                        ?>
                                        <a href="index.php?page=outpatients" class="nav-link">
                                            <h1 class="my-2"><?= $outpatient; ?></h1>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2">
                                    <div class="bg-primary rounded p-3 text-center text-white">
                                        <h5>Uncompleted Tasks</h5>
                                        <?php
                                        $get_daily_tasks = $connection->query("SELECT * FROM doc_daily_tasks WHERE doctor_id = '$doc_id' AND `status`='Pending....'");
                                        $daily_tasks = $get_daily_tasks->num_rows;
                                        ?>
                                        <a href="index.php?page=daily_tasks" class="nav-link">
                                            <h1 class="my-2"><?= $daily_tasks; ?></h1>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2">
                                    <div class="bg-danger rounded p-3 text-center text-white">
                                        <h5>Cancelled Appointments</h5>
                                        <?php
                                        $get_cancelled_a = $connection->query("SELECT * FROM appointments WHERE doctor_id = '$doc_id' AND `status` ='Cancelled'");
                                        $cancelled_a = $get_cancelled_a->num_rows;
                                        ?>
                                        <a href="index.php?page=cancelled_appointments" class="nav-link">
                                            <h1 class="my-2"><?= $cancelled_a; ?></h1>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 my-2">
                                    <div class="bg-primary rounded p-3 text-center text-white">
                                        <h5>Today Lab Test Result</h5>
                                        <?php
                                        $get_date = $connection->query("SELECT test_date FROM laboratory");
                                        $row_date = $get_date->fetch_array();
                                        $date_from_db = $row_date['test_date'];
                                        $current_date = date("Y-m-d");

                                        $date_from_db_date = date("Y-m-d", strtotime($date_from_db));
                                        $get_lab_test = $connection->query("SELECT * FROM laboratory WHERE test_date = '$current_date'");
                                        $lab_test = $get_lab_test->num_rows;
                                        ?>
                                        <a href="index.php?page=lab_test_results" class="nav-link">
                                            <h1 class="my-2"><?= $lab_test; ?></h1>
                                        </a>
                                    </div>
                                </div>
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
                                <div class="row mt-2 mb-2">
                                    <div class="col-md-6">
                                        <h5>Booked Appointment Records</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 text-right">
                                                <h5>Search:</h5>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="search" name="search" id="searchbar" autocomplete="off" class="form-control">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Patient Name</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $i = 1;
                                    $appointment = $connection->query("SELECT * FROM appointments ap INNER JOIN patients pa ON ap.patient_id = pa.patient_id WHERE ap.doctor_id = '$doc_id' AND ap.doctor_reply = 'Pending....' AND ap.status = 'Pending....'");
                                    if ($appointment->num_rows < 1) {
                                    ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No booked Appointment Yet</td>
                                        </tr>
                                </table>
                            <?php
                                    }
                                    foreach ($appointment as $index => $row) {
                            ?>
                                <tbody id="cat">
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                        <td><?= $row['date']; ?></td>
                                        <td><?= $row['time']; ?></td>
                                        <td><?= $row['message']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#replyMessage<?= $index; ?>">Reply</button>

                                        </td>
                                        <div class="modal fade" id="replyMessage<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Reply Patient' Message</h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="my-3">
                                                            <label for="msg" class="form-label text-primary">Patient Message :</label>
                                                            <p><?= $row['message']; ?></p>
                                                        </div>
                                                        <form method="post">
                                                            <?php
                                                            if (isset($_POST['reply'])) {
                                                                $patient_id = $_POST['patient_id'];
                                                                $message = $_POST['message'];
                                                                $doctor_message = $_POST['reply_message'];

                                                                $send_reply = $connection->query("UPDATE appointments SET doctor_reply = '$doctor_message' WHERE `message` = '$message' AND patient_id = '$patient_id' AND doctor_id = '$doc_id'");
                                                                if ($send_reply) {
                                                                    $_SESSION['$doctor_reply'] = "Message Sent Successfully";
                                                                }
                                                            }
                                                            ?>
                                                            <input type="hidden" name="patient_id" value="<?= $row['patient_id']; ?>">
                                                            <input type="hidden" name="message" value="<?= $row['message']; ?>">
                                                            <div class="my-3">
                                                                <label for="reply" class="form-label text-primary">Doctor Message :</label>
                                                                <textarea name="reply_message" id="reply" autocomplete="off" required cols="15" rows="5" class="form-control"></textarea>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" name="reply" value="Reply" class="btn btn-primary">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                    </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                </tbody>
                            <?php
                                    }
                            ?>

                            </table>
                            </div>
                        </div>
                    </div>
                <?php
                }
                if ($page == 'upcomming_appointments') {
                ?>
                    <div class="col-md-12">
                        <div class="row mt-2 mb-2">
                            <div class="col-md-6">
                                <h5>Upcomming Appointment Records</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 text-right">
                                        <h5>Search:</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="search" name="search" id="searchbar" autocomplete="off" class="form-control">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                                <th>Current Status</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $i = 1;
                            $appointment = $connection->query("SELECT * FROM appointments ap INNER JOIN patients pa ON ap.patient_id = pa.patient_id WHERE ap.doctor_id = '$doc_id' AND ap.doctor_reply != 'Pending....' AND ap.status = 'Pending....'");
                            if ($appointment->num_rows < 1) {
                            ?>
                                <tr>
                                    <td colspan="6" class="text-center">No Upcomming Appointment Yet</td>
                                </tr>
                        </table>
                    <?php
                            }
                            foreach ($appointment as $index => $row) {
                    ?>
                        <tbody id="cat">
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                <td><?= $row['date']; ?></td>
                                <td><?= $row['time']; ?></td>
                                <td><?= $row['status']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#viewMore<?= $index; ?>">View</button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#appointmentDone<?= $index; ?>">Done</button>
                                </td>
                                <div class="modal fade" id="viewMore<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Appointment Details</h1>
                                            </div>
                                            <div class="modal-body">
                                                <h5><span class="text-primary">Patient Name :</span> &nbsp; <?= $row['first_name']; ?> <?= $row['last_name']; ?></h5>
                                                <h5><span class="text-primary">Appointment Date :</span> &nbsp; <?= $row['date']; ?></h5>
                                                <h5><span class="text-primary">Appointment Time :</span> &nbsp; <?= $row['time']; ?></h5>
                                                <h5><span class="text-primary">Patient Message :</span> &nbsp; <?= $row['message']; ?></h5>
                                                <h5><span class="text-primary">Your Reply :</span> &nbsp; <?= $row['doctor_reply']; ?></h5>
                                                <h5><span class="text-primary">Current Staus :</span> &nbsp; <?= $row['status']; ?></h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="appointmentDone<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Appointment Status</h1>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure this appointment with <span class="text-primary"><?= $row['first_name']; ?> <?= $row['last_name']; ?></span> is done on <?= $row['date']; ?> ?</p>

                                                <?php
                                                if (isset($_POST['done'])) {
                                                    $patient_id = $_POST['patient_id'];
                                                    $doctor_id = $_POST['doctor_id'];
                                                    $appointment_id = $_POST['appointment_id'];
                                                    $patient_conditions = $_POST['patient_conditions'];

                                                    $update_appointment_status = $connection->query("UPDATE appointments SET `status` = 'Done', patient_conditions = '$patient_conditions' WHERE patient_id = '$patient_id' AND appointment_id = '$appointment_id' AND doctor_id = '$doctor_id'");
                                                    if ($update_appointment_status) {
                                                        $_SESSION['appointment_status_done'] = "Done Successfully";
                                                    }
                                                }
                                                ?>
                                                <form method="post">
                                                    <div class="form-group">
                                                        <label for="patient_conditions" class="form-group">Patient Condtions :</label>
                                                        <textarea name="patient_conditions" id="patient_conditions" cols="30" rows="5" class="form-control" required></textarea>
                                                    </div>
                                                    <input type="hidden" name="patient_id" value="<?= $row['patient_id']; ?>">
                                                    <input type="hidden" name="doctor_id" value="<?= $doc_id; ?>">
                                                    <input type="hidden" name="appointment_id" value="<?= $row['appointment_id']; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="done" class="btn btn-primary">Yes</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </tr>
                        </tbody>
                    <?php
                            }
                    ?>

                    </table>

                    </div>
                <?php
                }
                if ($page == 'cancelled_appointments') {
                ?>
                    <div class="col-md-12">
                        <div class="row mt-2 mb-2">
                            <div class="col-md-6">
                                <h5>Cancelled Appointment Records</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 text-right">
                                        <h5>Search:</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="search" name="search" id="searchbar" autocomplete="off" class="form-control">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Appointment Date</th>
                                <th>Current Status</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $i = 1;
                            $appointment = $connection->query("SELECT * FROM appointments ap INNER JOIN patients pa ON ap.patient_id = pa.patient_id WHERE ap.doctor_id = '$doc_id' AND ap.status = 'Cancelled'");
                            if ($appointment->num_rows < 1) {
                            ?>
                                <tr>
                                    <td colspan="5" class="text-center">No Cancelled Appointment Yet</td>
                                </tr>
                        </table>
                    <?php
                            }
                            foreach ($appointment as $index => $row) {
                    ?>
                        <tbody id="cat">
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                <td><?= $row['date']; ?></td>
                                <td class="text-danger"><?= $row['status']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#viewMore<?= $index; ?>">View</button>
                                </td>
                                <div class="modal fade" id="viewMore<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Appointment Details</h1>
                                            </div>
                                            <div class="modal-body">
                                                <h5><span class="text-primary">Patient Name :</span> &nbsp; <?= $row['first_name']; ?> <?= $row['last_name']; ?></h5>
                                                <h5><span class="text-primary">Appointment Date :</span> &nbsp; <?= $row['date']; ?></h5>
                                                <h5><span class="text-primary">Appointment Time :</span> &nbsp; <?= $row['time']; ?></h5>
                                                <h5><span class="text-primary">Current Staus :</span> &nbsp; <?= $row['status']; ?></h5>
                                                <h5><span class="text-primary">Cancelled By :</span> &nbsp; <?= $row['cancelled_by']; ?></h5>
                                                <h5><span class="text-primary">Reason :</span> &nbsp; <?= $row['reason_for_cancelling']; ?></h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        </tbody>
                    <?php
                            }
                    ?>

                    </table>

                    </div>
                <?php

                }
                if ($page == 'appointments_history') {
                ?>
                    <div class="col-md-12">
                        <div class="row mt-2 mb-2">
                            <div class="col-md-6">
                                <h5>Appointment History Records</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 text-right">
                                        <h5>Search:</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="search" name="search" id="searchbar" autocomplete="off" class="form-control">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Appointment Date</th>
                                <th>Current Status</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $i = 1;
                            $appointment = $connection->query("SELECT * FROM appointments ap INNER JOIN patients pa ON ap.patient_id = pa.patient_id WHERE ap.doctor_id = '$doc_id' AND ap.status = 'Done'");
                            if ($appointment->num_rows < 1) {
                            ?>
                                <tr>
                                    <td colspan="5" class="text-center">No Appointment History Yet</td>
                                </tr>
                        </table>
                    <?php
                            }
                            foreach ($appointment as $index => $row) {
                    ?>
                        <tbody id="cat">
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                <td><?= $row['date']; ?></td>
                                <td class="text-success"><?= $row['status']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#viewMore<?= $index; ?>">View</button>
                                </td>
                                <div class="modal fade" id="viewMore<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Appointment Details</h1>
                                            </div>
                                            <div class="modal-body">
                                                <h5><span class="text-primary">Booked by :</span> &nbsp; <?= $row['first_name']; ?> <?= $row['last_name']; ?></h5>
                                                <h5><span class="text-primary">Appointment Date :</span> &nbsp; <?= $row['date']; ?></h5>
                                                <h5><span class="text-primary">Appointment Time :</span> &nbsp; <?= $row['time']; ?></h5>
                                                <h5><span class="text-primary">Patient Message :</span> &nbsp; <?= $row['message']; ?></h5>
                                                <h5><span class="text-primary">Your Reply :</span> &nbsp; <?= $row['doctor_reply']; ?></h5>
                                                <h5><span class="text-primary">Current Staus :</span> &nbsp; <?= $row['status']; ?></h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        </tbody>
                    <?php
                            }
                    ?>

                    </table>
                    </div>
                <?php

                }
                if ($page == 'inpatients') {
                ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row mt-2 mb-2">
                                    <div class="col-md-6">
                                        <h5>Inpatient Records</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 text-right">
                                                <h5>Search:</h5>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="search" name="search" id="searchbar" autocomplete="off" class="form-control">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Patient Name</th>
                                        <th>Diseases</th>
                                        <th>Discharge Date</th>
                                        <th>Current Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $i = 1;
                                    $admitted_patients = $connection->query("SELECT pa.patient_id, pa.first_name, pa.last_name, ad.admission_id, ad.patient_id, ad.admission_date, ad.discharge_date, ad.admission_status, ad.next_of_kin, ad.next_of_kin_phone, la.test_name, ro.room_name, ro.room_id, be.bed_number, la.lab_test_id, be.bed_id FROM admissions ad INNER JOIN patients pa ON ad.patient_id = pa.patient_id INNER JOIN laboratory la ON ad.lab_test_id = la.lab_test_id INNER JOIN room  ro ON ad.room_id = ro.room_id INNER JOIN beds be ON ad.bed_id = be.bed_id WHERE ad.doctor_id = '$doc_id' AND ad.admission_status = 'Inpatient'");
                                    if ($admitted_patients->num_rows < 1) {
                                    ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No Inpatients Yet</td>
                                        </tr>
                                    <?php
                                    }
                                    foreach ($admitted_patients as $inpatient => $row) {
                                    ?>
                                        <tbody id="cat">
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                                <td><?= $row['test_name']; ?></td>
                                                <td><?= $row['discharge_date']; ?></td>
                                                <td><?= $row['admission_status']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#viewMore<?= $inpatient; ?>">View</button>
                                                    <a href="index.php?page=add_prescriptions&patient_id=<?= $row['patient_id']; ?>" class="btn btn-primary me-2">Prescribe</a>
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#discharge<?= $inpatient; ?>">Discharge</button>
                                                </td>
                                                <div class="modal fade" id="viewMore<?= $inpatient; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Inpatient Details</h1>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5><span class="text-primary">Patient Name :</span> &nbsp; <?= $row['first_name']; ?> <?= $row['last_name']; ?></h5>
                                                                <h5><span class="text-primary">Disease :</span> &nbsp; <?= $row['test_name']; ?></h5>
                                                                <h5><span class="text-primary">Admission Date :</span> &nbsp; <?= $row['admission_date']; ?></h5>
                                                                <h5><span class="text-primary">Room Name :</span> &nbsp; <?= $row['room_name']; ?></h5>
                                                                <h5><span class="text-primary">Bed Number :</span> &nbsp; <?= $row['bed_number']; ?></h5>
                                                                <h5><span class="text-primary">Discharge Date :</span> &nbsp; <?= $row['discharge_date']; ?></h5>
                                                                <h5><span class="text-primary">Current Staus :</span> &nbsp; <?= $row['admission_status']; ?></h5>
                                                                <h5><span class="text-primary">Next Of Kin :</span> &nbsp; <?= $row['next_of_kin']; ?></h5>
                                                                <h5><span class="text-primary">Next Of Kin Phone Number :</span> &nbsp; <?= $row['next_of_kin_phone']; ?></h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="discharge<?= $inpatient; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Discharge <?= $row['first_name']; ?> <?= $row['last_name']; ?></h1>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-primary">Are you sure you want to discharge <?= $row['first_name']; ?> <?= $row['last_name']; ?> ?</p>
                                                                <?php
                                                                if (isset($_POST['discharge_patient'])) {
                                                                    $admission_id = $_POST['admission_id'];
                                                                    $patient_id = $_POST['patient_id'];
                                                                    $room_id = $_POST['room_id'];
                                                                    $admission_date = $_POST['admission_date'];
                                                                    $discharge_date = $_POST['discharge_date'];
                                                                    $bed_id = $_POST['bed_id'];
                                                                    $lab_test_id = $_POST['lab_test_id'];
                                                                    $discharge_type = $_POST['discharge_type'];
                                                                    $discharge_report = $_POST['discharge_report'];
                                                                    $discharge_patient = $connection->query("UPDATE `admissions` SET `patient_id`='$patient_id',`doctor_id`='$doc_id',`admission_date`='$admission_date',`discharge_date`='$discharge_date',`room_id`='$room_id',`bed_id`='$bed_id',`lab_test_id`='$lab_test_id',`admission_status`='Outpatient',`discharge_type`='$discharge_type',`discharge_report`='$discharge_report' WHERE `admission_id`='$admission_id'");
                                                                    if ($discharge_patient) {
                                                                        $_SESSION['discharge_patient'] = "Discharged Successfully";
                                                                    } else {
                                                                        $error['error'] = "Something Went Wrong !";
                                                                    }
                                                                }
                                                                ?>
                                                                <form method="post">
                                                                    <input type="hidden" name="admission_id" value="<?= $row['admission_id']; ?>">
                                                                    <input type="hidden" name="patient_id" value="<?= $row['patient_id']; ?>">
                                                                    <input type="hidden" name="room_id" value="<?= $row['room_id']; ?>">
                                                                    <input type="hidden" name="bed_id" value="<?= $row['bed_id']; ?>">
                                                                    <input type="hidden" name="lab_test_id" value="<?= $row['lab_test_id']; ?>">
                                                                    <input type="hidden" name="admission_date" value="<?= $row['admission_date']; ?>">
                                                                    <input type="hidden" name="discharge_date" value="<?= $row['discharge_date']; ?>">
                                                                    <div class="form-group my-2">
                                                                        <label for="discharge_type" class="form-label">Select Discharge Type :</label>
                                                                        <select name="discharge_type" id="discharge_type" class="form-control">
                                                                            <option value="Home Discharge">Home Discharge</option>
                                                                            <option value="Transfer Discharge">Transfer Discharge</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group my-2">
                                                                        <label for="discharge_report" class="form-label">Discharge Report :</label>
                                                                        <input type="text" name="discharge_report" id="discharge_report" class="form-control" autocomplete="off" required>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" value="Yes" name="discharge_patient" class="btn btn-primary">
                                                                </form>

                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        </tbody>
                                    <?php
                                    }
                                    ?>

                                </table>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                    </div>
                <?php
                }
                if ($page == 'add_prescriptions') {
                ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 mt-3">
                                <?php
                                if (isset($_GET['patient_id'])) {
                                    $patient_id = $_GET['patient_id'];
                                    $get_patient_name = $connection->query("SELECT * FROM patients pa INNER JOIN laboratory la ON pa.patient_id = la.patient_id WHERE pa.patient_id ='$patient_id'");
                                    $patient_name = $get_patient_name->fetch_assoc();
                                }
                                if (isset($_POST['add_prescriptions'])) {
                                    $patient_id = $_POST['patient_id'];
                                    $doctor_id = $_POST['doctor_id'];
                                    $disease = $_POST['disease'];
                                    $medication = $_POST['medication'];
                                    $dosage = $_POST['dosage'];
                                    $instructions = $_POST['instructions'];

                                    $error = array();

                                    if (empty($medication)) {
                                        $error['error'] = "Enter medications !";
                                    } else if (empty($dosage)) {
                                        $error['error'] = "Enter dosages !";
                                    } else if (empty($instructions)) {
                                        $error['error'] = "Enter instructions !";
                                    } else {
                                        $add_prescriptions = $connection->query("INSERT INTO prescriptions (patient_id,doctor_id,diseases,medication,dosage,instructions,bill) VALUES ('$patient_id','$doctor_id','$disease','$medication','$dosage','$instructions','Pending....')");
                                        if ($add_prescriptions) {
                                            $_SESSION['add_prescriptions'] = "Added Successfully";
                                        }
                                    }
                                }
                                ?>
                                <form action="" method="post" class="p-4 shadow-lg rounded">
                                    <h5 class="text-center">Add prescriptions for <span class="text-primary"><?= $patient_name['first_name']; ?> <?= $patient_name['last_name']; ?></span></h5>
                                    <div class="form-group my-3">
                                        <input type="hidden" name="patient_id" value="<?= $patient_id; ?>" class="form-control">
                                        <input type="hidden" name="doctor_id" value="<?= $doc_id; ?>" class="form-control">
                                        <input type="hidden" name="disease" value="<?= $patient_name['test_name']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="medication" class="form-label">Medications :</label>
                                        <textarea name="medication" id="medication" cols="30" rows="3" class="form-control" value="<?php if (isset($_POST['medication'])) echo $_POST['medication']; ?>" autocomplete="off"></textarea>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="dosage" class="form-label">Dosages :</label>
                                        <textarea name="dosage" id="dosage" cols="30" rows="3" class="form-control" value="<?php if (isset($_POST['dosage'])) echo $_POST['dosage']; ?>" autocomplete="off"></textarea>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="instructions" class="form-label">Instructions :</label>
                                        <textarea name="instructions" id="instructions" cols="30" rows="5" class="form-control" value="<?php if (isset($_POST['instructions'])) echo $_POST['instructions']; ?>" autocomplete="off"></textarea>
                                    </div>
                                    <div class="form-group my-3">
                                        <input type="submit" name="add_prescriptions" value="Submit" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                <?php
                }
                if ($page == 'prescriptions') {
                ?>
                    <div class="col-md-12">
                        <div class="row mt-2 mb-2">
                            <div class="col-md-6">
                                <h5>Prescription Records</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 text-right">
                                        <h5>Search:</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="search" name="search" id="searchbar" autocomplete="off" class="form-control">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="mt-2 table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Prescribed Date/Time</th>
                                <th>Medications</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $i = 1;
                            $get_prescriptions = $connection->query("SELECT pr.prescription_id, pr.date,pr.medication,pr.dosage,pr.instructions,pa.first_name,pa.last_name,do.first_name as fname,do.last_name as lname FROM prescriptions pr INNER JOIN patients pa ON pr.patient_id = pa.patient_id INNER JOIN doctors do ON pr.doctor_id = do.doctor_id");
                            if ($get_prescriptions->num_rows < 1) {
                            ?>
                                <tr>
                                    <td colspan="7" class="text-center">No Prescriptions Yet</td>
                                </tr>
                            <?php
                            }
                            foreach ($get_prescriptions as $presc => $row) {
                            ?>
                                <tbody id="cat">
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                        <td><?= $row['date']; ?></td>
                                        <td><?= $row['medication']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#viewMore<?= $presc; ?>">View</button>
                                            <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#deletePrescription<?= $presc; ?>">Delete</button>
                                            
                                        </td>
                                        <!-- modal for viewing more details  -->
                                        <div class="modal fade" id="viewMore<?= $presc; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Prescription Details</h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5><span class="text-primary">Patient Name :</span> &nbsp; <?= $row['first_name']; ?> <?= $row['last_name']; ?></h5>
                                                        <h5><span class="text-primary">Prescription Date :</span> &nbsp; <?= $row['date']; ?></h5>
                                                        <h5><span class="text-primary my-2">Medications :</span> &nbsp; <?= $row['medication']; ?></h5>
                                                        <h5><span class="text-primary my-2">Dosage :</span> &nbsp; <?= $row['dosage']; ?></h5>
                                                        <h5><span class="text-primary my-2">Instructions :</span> &nbsp; <?= $row['instructions']; ?></h5>
                                                        <h5><span class="text-primary">Prescribed by :</span> &nbsp;Dr. <?= $row['fname']; ?> <?= $row['lname']; ?></h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                             <!-- modal for deleting prescription  -->
                                             <div class="modal fade" id="deletePrescription<?= $presc; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Prescription</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-danger">
                                                        <p>Are you sure you want to delete this prescription?</p>
                                                        <?php
                                                        if (isset($_POST['delete_prescription'])) {
                                                            $id = $_POST['id'];

                                                            $done_task = $connection->query("DELETE FROM prescriptions WHERE prescription_id = '$id'");
                                                            if ($done_task) {
                                                                $_SESSION['delete_prescription'] = "Deleted Successfully";
                                                            }
                                                        }
                                                        ?>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id" value="<?= $row['prescription_id']; ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="delete_prescription" class="btn btn-primary">Yes</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                </tbody>
                            <?php
                            }
                            ?>

                        </table>
                    </div>
                <?php
                }
                if ($page == 'outpatients') {
                ?>
                    <div class="col-md-12">
                        <div class="row mt-2 mb-2">
                            <div class="col-md-6">
                                <h5>Outpatient Records</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 text-right">
                                        <h5>Search:</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="search" name="search" id="searchbar" autocomplete="off" class="form-control">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>Diseases</th>
                                <th>Discharge Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $i = 1;
                            $admitted_patients = $connection->query("SELECT pa.first_name, pa.last_name, pa.phone, pa.location, pa.next_of_kin, pa.next_of_kin_phone, ad.admission_date, ad.discharge_date, ad.admission_status, la.test_name, ro.room_name, be.bed_number FROM admissions ad INNER JOIN patients pa ON ad.patient_id = pa.patient_id INNER JOIN laboratory la ON ad.lab_test_id = la.lab_test_id INNER JOIN room  ro ON ad.room_id = ro.room_id INNER JOIN beds be ON ad.bed_id = be.bed_id WHERE ad.doctor_id = '$doc_id' AND ad.admission_status = 'Outpatient'");
                            if ($admitted_patients->num_rows < 1) {
                            ?>
                                <tr>
                                    <td colspan="7" class="text-center">No Outpatients Yet</td>
                                </tr>
                            <?php
                            }
                            foreach ($admitted_patients as $inpatient => $row) {
                            ?>
                                <tbody id="cat">
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                        <td><?= $row['test_name']; ?></td>
                                        <td><?= $row['discharge_date']; ?></td>
                                        <td><?= $row['admission_status']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#viewMore<?= $inpatient; ?>">View</button>

                                        </td>
                                        <div class="modal fade" id="viewMore<?= $inpatient; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Outpatient Details</h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5><span class="text-primary">Patient Name :</span> &nbsp; <?= $row['first_name']; ?> <?= $row['last_name']; ?></h5>
                                                        <h5><span class="text-primary">Phone Number :</span> &nbsp; <?= $row['phone']; ?></h5>
                                                        <h5><span class="text-primary">Disease :</span> &nbsp; <?= $row['test_name']; ?></h5>
                                                        <h5><span class="text-primary">Admission Date :</span> &nbsp; <?= $row['admission_date']; ?></h5>
                                                        <h5><span class="text-primary">Discharge Date :</span> &nbsp; <?= $row['discharge_date']; ?></h5>
                                                        <h5><span class="text-primary">Current Staus :</span> &nbsp; <?= $row['admission_status']; ?></h5>
                                                        <h5><span class="text-primary">District :</span> &nbsp; <?= $row['location']; ?></h5>
                                                        <h5><span class="text-primary">Next of kin :</span> &nbsp; <?= $row['next_of_kin']; ?></h5>
                                                        <h5><span class="text-primary">Next of kin Phone Number:</span> &nbsp; <?= $row['next_of_kin_phone']; ?></h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                </tbody>
                            <?php
                            }
                            ?>

                        </table>


                    </div>
                <?php
                }
                if ($page == 'laboratory') {
                ?>
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row mt-2 mb-2">
                                <div class="col-md-6">
                                    <h5>Patient Records</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <h5>Search:</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="search" name="search" id="searchbar" autocomplete="off" class="form-control">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th>#</th>
                                    <th>Patient Name</th>
                                    <th>Patient Conditions</th>
                                    <th>Attended By</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                                $i = 1;
                                $patient_details = $connection->query("SELECT ap.patient_conditions, pa.patient_id, pa.first_name, pa.last_name, do.first_name as fname, do.last_name as lname FROM appointments ap INNER JOIN patients pa ON ap.patient_id = pa.patient_id INNER JOIN doctors do ON ap.doctor_id = do.doctor_id WHERE ap.status = 'Done' AND ap.patient_conditions != ''");
                                if ($patient_details->num_rows < 1) {
                                ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Patient Details Available Yet</td>
                                    </tr>
                            </table>
                        <?php
                                }
                                foreach ($patient_details as $test => $row) {
                        ?>
                            <tbody id="cat">
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                    <td><?= $row['patient_conditions']; ?></td>
                                    <td><?= $row['fname']; ?> <?= $row['lname']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#testPatient<?= $test; ?>">Test Patient</button>

                                    </td>
                                    <div class="modal fade" id="testPatient<?= $test; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Laboratory Test For <span class="text-primary"><?= $row['first_name']; ?> <?= $row['last_name']; ?></span></h1>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    if (isset($_POST['test_patient'])) {
                                                        $patient_id = $_POST['patient_id'];
                                                        $doctor_id = $_POST['doctor_id'];
                                                        $test_name = $_POST['test_name'];
                                                        $test_result = $_POST['test_result'];
                                                        $test_report = $_POST['test_report'];

                                                        $laboratory_test = $connection->query("INSERT INTO laboratory (patient_id, test_name, test_result, doctor_id, report) VALUES ('$patient_id', '$test_name', '$test_result', '$doctor_id', '$test_report')");
                                                        if ($laboratory_test) {
                                                            $_SESSION['test_patient'] = "Submitted Successfully";
                                                        }
                                                    }
                                                    ?>
                                                    <form method="post">
                                                        <input type="hidden" name="patient_id" value="<?= $row['patient_id']; ?>">
                                                        <input type="hidden" name="doctor_id" value="<?= $doc_id; ?>">
                                                        <div class="form-group my-2">
                                                            <label for="test_name" class="form-label">Test Name/Disease Name :</label>
                                                            <input type="text" name="test_name" id="test_name" class="form-control" autocomplete="off" required>
                                                        </div>
                                                        <div class="form-group my-2">
                                                            <label for="test_result" class="form-label">Select Test Result :</label>
                                                            <select name="test_result" id="test_result" class="form-control">
                                                                <option value="Positive">Positive</option>
                                                                <option value="Negative">Negative</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group my-2">
                                                            <label for="test_report" class="form-label">Test Report :</label>
                                                            <input type="text" name="test_report" id="test_report" class="form-control" autocomplete="off" required>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" name="test_patient" value="Submit" class="btn btn-primary">
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            </tbody>
                        <?php
                                }
                        ?>

                        </table>
                        </div>
                    </div>
                <?php

                }
                if ($page == 'lab_test_results') {
                ?>
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row mt-2 mb-2">
                                        <div class="col-md-6">
                                            <h5>Laboratory Test Records</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <h5>Search:</h5>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="search" name="search" id="searchbar" autocomplete="off" class="form-control">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>#</th>
                                            <th>Patient Name</th>
                                            <th>Tested Disease</th>
                                            <th>Test Result</th>
                                            <th>Test Date</th>
                                            <th>Test Report</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php
                                        $i = 1;
                                        $patient_tested = $connection->query("SELECT  la.lab_test_id, la.test_name, la.test_result, la.test_date, la.report, pa.patient_id, pa.first_name, pa.last_name, do.first_name as fname, do.last_name as lname FROM laboratory la INNER JOIN patients pa ON la.patient_id = pa.patient_id INNER JOIN doctors do ON la.doctor_id = do.doctor_id");
                                        if ($patient_tested->num_rows < 1) {
                                        ?>
                                            <tr>
                                                <td colspan="7" class="text-center">No Tested Patient Yet</td>
                                            </tr>
                                    </table>
                                <?php
                                        }
                                        foreach ($patient_tested as $test => $row) {
                                ?>
                                    <tbody id="cat">
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row['first_name']; ?> <?= $row['last_name']; ?></td>
                                            <td><?= $row['test_name']; ?></td>
                                            <td><?= $row['test_result']; ?></td>
                                            <td><?= $row['test_date']; ?></td>
                                            <td><?= $row['report']; ?></td>
                                            <td>
                                                <a href="index.php?page=admit_patient&patient_id=<?= $row['patient_id']; ?>" class="btn btn-primary">Admit</a>
                                                <a href="index.php?page=add_prescriptions&patient_id=<?= $row['patient_id']; ?>" class="btn btn-success">Prescribe</a>
                                            </td>

                                        </tr>
                                    </tbody>
                                <?php
                                        }
                                ?>

                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                if ($page == 'admit_patient') {
                ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 mt-3">
                                <?php
                                if (isset($_GET['patient_id'])) {
                                    $patient_id = $_GET['patient_id'];
                                    $get_lab_test_id = $connection->query("SELECT * FROM laboratory la INNER JOIN patients pa WHERE la.patient_id = '$patient_id'");
                                    $row_lab = $get_lab_test_id->fetch_assoc();
                                }
                                if (isset($_POST['admit_patient'])) {
                                    $patient_id = $_POST['patient_id'];
                                    $doctor_id = $_POST['doctor_id'];
                                    $lab_test_id = $_POST['lab_test_id'];
                                    $discharge_date = $_POST['discharge_date'];
                                    $room_id = $_POST['room_id'];
                                    $bed_id = $_POST['bed_id'];
                                    $next_of_kin = $_POST['next_of_kin'];
                                    $next_of_kin_phone = $_POST['next_of_kin_phone'];

                                    $error = array();
                                    if (empty($next_of_kin)) {
                                        $error['error'] = "Enter next of kin name !";
                                    } else if (empty($next_of_kin_phone)) {
                                        $error['error'] = "Enter next of kin number !";
                                    } else if (empty($discharge_date)) {
                                        $error['error'] = "Enter Discharge Date !";
                                    } else {
                                        $admit_patient = $connection->query("INSERT INTO admissions (patient_id, doctor_id, discharge_date, room_id, bed_id, lab_test_id, admission_status, next_of_kin, next_of_kin_phone) VALUES ('$patient_id', '$doctor_id', '$discharge_date', '$room_id', '$bed_id', '$lab_test_id', 'Inpatient', '$next_of_kin', '$next_of_kin_phone')");
                                        if ($admit_patient) {
                                            $_SESSION['admit_patient'] = "Admitted Successfully";
                                        }
                                    }
                                }
                                ?>
                                <form method="post" class="shadow-lg p-4 rounded">
                                    <h5 class="text-center">Admit <span class="text-primary"><?= $row_lab['first_name']; ?> <?= $row_lab['last_name']; ?></span> </h5>
                                    <input type="hidden" name="patient_id" value="<?= $patient_id; ?>">
                                    <input type="hidden" name="lab_test_id" value="<?= $row_lab['lab_test_id']; ?>">
                                    <input type="hidden" name="doctor_id" value="<?= $doc_id; ?>">
                                    <div class="form-group my-2">
                                        <label for="next_of_kin" class="form-label">Next of kin :</label>
                                        <input type="text" name="next_of_kin" id="next_of_kin" autocomplete="off" value="<?php if (isset($_POST['next_of_kin'])) echo $_POST['next_of_kin'];  ?>" placeholder="Enter name" class="form-control">
                                    </div>
                                    <div class="form-group my-2">
                                        <label for="next_of_kin_p" class="form-label">Next of kin :</label>
                                        <input type="text" name="next_of_kin_phone" id="next_of_kin_p" value="<?php if (isset($_POST['next_of_kin_phone'])) echo $_POST['next_of_kin_phone'];  ?>" autocomplete="off" placeholder="Enter phone number" class="form-control">
                                    </div>
                                    <div class="form-group my-2">
                                        <label for="discharge" class="form-label">Discharge Date :</label>
                                        <input type="date" name="discharge_date" id="discharge" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group my-2">
                                        <label for="room" class="form-label">Select Room :</label>
                                        <select name="room_id" id="room" class="form-control">
                                            <?php
                                            $get_room_id = $connection->query("SELECT *  FROM room");

                                            while ($row_room = $get_room_id->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_room['room_id']; ?>"><?= $row_room['room_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group my-2">
                                        <label for="bed" class="form-label">Select Bed :</label>
                                        <select name="bed_id" id="bed" class="form-control">
                                            <?php



                                            $beds_available = $connection->query("SELECT be.bed_id, be.bed_number, ro.room_name FROM beds be INNER JOIN room ro ON be.room_id = ro.room_id LEFT JOIN admissions ad ON ad.bed_id = be.bed_id  WHERE ad.bed_id is NULL");
                                            while ($row_bed = $beds_available->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $row_bed['bed_id']; ?>"><?= $row_bed['bed_number']; ?> in <?= $row_bed['room_name']; ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="form-group my-3 d-flex">
                                        <input type="submit" name="admit_patient" value="Admit" class="btn btn-primary me-2">
                                        <a href="index.php?page=lab_test_results" class="btn btn-secondary">Back</a>
                                    </div>
                                </form>

                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                <?php
                }
                if ($page == 'myprofile') {
                ?>
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                                        <?php
                                        include("../parts/db-con.php");
                                        $doc_id = $_SESSION["id"];
                                        $profile = $connection->query("SELECT * FROM doctors do INNER JOIN departments de ON de.department_id = do.department_id WHERE do.doctor_id = $doc_id");
                                        $profile_row = $profile->fetch_assoc();
                                        $opassword = $profile_row["password"];
                                        ?>
                                        <div class="profile-img text-center">
                                            <img src="assets/img/<?php echo $profile_row['profile_image']; ?>" style="width:150px;height:150px;border-radius:50%;border:5px solid purple;padding:2px;">
                                        </div>

                                        <div class="col-md-12 mt-5">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5> First Name:</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $profile_row['first_name']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Last Name:</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $profile_row['last_name']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Userame:</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $profile_row['username']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Specialization:</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $profile_row['specialization']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Email:</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $profile_row['email']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Address:</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $profile_row['address']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Phone Number:</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $profile_row['phone_number']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Department:</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $profile_row['department_name']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_POST["edit_email"])) {
                                        $email = $_POST['email'];
                                        $error = array();
                                        if (empty($email)) {
                                            $error['error'] = 'Enter Email';
                                        } else {
                                            $update_profile_email = $connection->query("UPDATE doctors SET email = '$email' WHERE doctor_id = '$doc_id'");
                                            if ($update_profile_email) {
                                                $_SESSION["update"] = "Updated Successfully";
                                            }
                                        }
                                    }

                                    if (isset($_POST['edit_password'])) {
                                        $password = $_POST['opassword'];
                                        $npassword = $_POST['npassword'];


                                        $error = array();
                                        if (empty($password)) {
                                            $error['error'] = 'Enter Old Password';
                                        } else if ($password != $opassword) {
                                            $error['error'] = 'Incorrect Old Password';
                                        } else if (empty($npassword)) {
                                            $error['error'] = 'Enter New Password';
                                        } else {
                                            $update = $connection->query("UPDATE doctors SET `password` = '$npassword' WHERE doctor_id = '$doc_id'");
                                            if ($update) {
                                                $_SESSION["update"] = "Updated Successfully";
                                            } else {
                                                $error["error"] = "Failed Please Try Again" . $connection->error;
                                            }
                                        }
                                    }
                                    ?>
                                    <form method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded">
                                        <h5 class="text-center my-3">Change Email</h5>
                                        <div class="form-group-my-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="email" value="<?= $profile_row['email']; ?>" class="form-control">
                                        </div>
                                        <div class="form-group my-3">
                                            <input type="submit" value="Edit" name="edit_email" class="btn btn-primary">
                                        </div>
                                    </form>

                                    <form method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded">
                                        <h5 class="text-center my-3">Change Password</h5>
                                        <div class="form-group-my-3">
                                            <label class="form-label" for="password">Old Password</label>
                                            <input type="password" name="opassword" id="password" placeholder="Enter Old Password" class="form-control">
                                        </div>
                                        <div class="form-group-my-3">
                                            <label class="form-label" for="npassword">New Password</label>
                                            <input type="password" name="npassword" id="npassword" placeholder="Enter New Password" class="form-control">
                                        </div>
                                        <div class="form-group my-3">
                                            <input type="submit" value="Edit" name="edit_password" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-1"></div>
                                <?php

                                if (isset($_POST['edit_profile'])) {
                                    $profile_image = $_FILES['image']['name'];
                                    $error = array();
                                    if (empty($profile_image)) {
                                        $error['error'] = 'Choose Profile Image';
                                    } else {
                                        $update_profile_image = $connection->query("UPDATE doctors SET profile_image = '$profile_image' WHERE doctor_id = '$doc_id'");
                                        if ($update_profile_image) {
                                            $_SESSION['update'] = "Updated Successfully";
                                            move_uploaded_file($_FILES['image']['tmp_name'], "assets/img/$profile_image");
                                        } else {
                                            $error["error"] = "Update Failed !";
                                        }
                                    }
                                }

                                if (isset($_POST["edit_username"])) {
                                    $uname = $_POST['username'];
                                    $error = array();
                                    if (empty($uname)) {
                                        $error['error'] = 'Enter Username';
                                    } else {
                                        $update_profile_username = $connection->query("UPDATE doctors SET username = '$uname' WHERE doctor_id = '$doc_id'");
                                        if ($update_profile_username) {
                                            $_SESSION["update"] = "Updated Successfully";
                                        }
                                    }
                                }
                                if (isset($_POST["edit_address"])) {
                                    $address = $_POST['address'];
                                    $error = array();
                                    if (empty($address)) {
                                        $error['error'] = 'Enter Your Current Address';
                                    } else {
                                        $update_profile_address = $connection->query("UPDATE doctors SET `address` = '$address' WHERE doctor_id = '$doc_id'");
                                        if ($update_profile_address) {
                                            $_SESSION["update"] = "Updated Successfully";
                                        }
                                    }
                                }

                                if (isset($_POST["edit_phone"])) {
                                    $phone = $_POST['phone'];
                                    $error = array();
                                    if (empty($phone)) {
                                        $error['error'] = 'Enter Phone Number';
                                    } else {
                                        $update_profile_phone = $connection->query("UPDATE doctors SET phone_number = '$phone' WHERE doctor_id = '$doc_id'");
                                        if ($update_profile_phone) {
                                            $_SESSION["update"] = "Updated Successfully";
                                        }
                                    }
                                }



                                ?>
                                <div class="col-md-5 ">
                                    <form method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded" enctype="multipart/form-data">
                                        <h5 class="text-center my-3">Change Profile Picture</h5>
                                        <div class="form-group-my-3">
                                            <label class="form-label" for="profile">Change Profile Picture</label>
                                            <input type="file" name="image" id="profile" class="form-control">
                                        </div>
                                        <div class="form-group my-3">
                                            <input type="submit" value="Edit" name="edit_profile" class="btn btn-primary">
                                        </div>
                                    </form>

                                    <form action="" method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded">
                                        <h5 class="text-center my-3">Change Username</h5>
                                        <div class="form-group-my-3">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" name="username" id="username" value="<?= $profile_row['username']; ?>" class="form-control">
                                        </div>
                                        <div class="form-group my-3">
                                            <input type="submit" value="Edit" name="edit_username" class="btn btn-primary">
                                        </div>
                                    </form>

                                    <form action="" method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded">
                                        <h5 class="text-center my-3">Change Address</h5>
                                        <div class="form-group-my-3">
                                            <label class="form-label" for="address">Change Address</label>
                                            <input type="text" name="address" id="address" value="<?= $profile_row['address']; ?>" class="form-control">
                                        </div>
                                        <div class="form-group my-3">
                                            <input type="submit" value="Edit" name="edit_address" class="btn btn-primary">
                                        </div>
                                    </form>

                                    <form method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded">
                                        <h5 class="text-center my-3">Change Phone Number</h5>
                                        <div class="form-group-my-3">
                                            <label class="form-label" for="phone">Phone Number</label>
                                            <input type="text" name="phone" id="phone" value="<?= $profile_row['phone_number']; ?>" class="form-control">
                                        </div>
                                        <div class="form-group my-3">
                                            <input type="submit" value="Edit" name="edit_phone" class="btn btn-primary">
                                        </div>
                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>
                <?php
                }
                if ($page == 'daily_tasks') {
                ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <h5 class="text-left my-3">Time</h5>
                                <div class="watch shadow-lg bg-primary text-center text-white p-2 rounded">
                                    <div id="time"></div>
                                </div>
                                <script>
                                    function updateClock() {
                                        const now = new Date();
                                        const hours = now.getHours().toString().padStart(2, '0');
                                        const minutes = now.getMinutes().toString().padStart(2, '0');
                                        const seconds = now.getSeconds().toString().padStart(2, '0');

                                        const timeString = `${hours}:${minutes}:${seconds}`;

                                        document.getElementById('time').innerText = timeString;
                                    }

                                    // Update the clock every second
                                    setInterval(updateClock, 1000);

                                    // Initial call to display the clock immediately
                                    updateClock();
                                </script>
                            </div>
                            <div class="col-md-10">
                                <div class="shadow-lg p-5 rounded mt-3">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="my-2">
                                                    Today's Tasks
                                                </h5>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <div class="my-3">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTask">
                                                        Add Task
                                                    </button>

                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="addTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Task</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php
                                                            if (isset($_POST['add_task'])) {
                                                                $doctor_id = $_POST['doctor_id'];
                                                                $task = $_POST['task'];
                                                                $time = $_POST['time'];

                                                                $add_task = $connection->query("INSERT INTO doc_daily_tasks (doctor_id,task,task_time,`status`) VALUES ('$doctor_id','$task','$time','Pending....')");
                                                                if ($add_task) {
                                                                    $_SESSION['add_task'] = "Added Successfully";
                                                                }
                                                            }
                                                            ?>
                                                            <form action="" method="post">
                                                                <div class="form-group my-3">
                                                                    <label for="task" class="form-label">Enter Task</label>
                                                                    <input type="text" name="task" id="task" class="form-control" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" name="doctor_id" value="<?= $doc_id; ?>" class="form-control">
                                                                </div>
                                                                <div class="form-group my-3">
                                                                    <label for="time" class="form-label">Set Task Time</label>
                                                                    <input type="time" name="time" id="time" class="form-control" required>
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="add_task" class="btn btn-primary">Submit</button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <table class="table table-bordered">
                                        <tr>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Task Time</th>
                                            <th>Current Status</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php
                                        $i = 1;
                                        $get_date = $connection->query("SELECT `date` FROM doc_daily_tasks WHERE doctor_id = '$doc_id'");
                                        $row_date = $get_date->fetch_array();
                                        $date_from_db = $row_date['date'];
                                        $current_date = date("Y-m-d");

                                        $date_from_db_date = date("Y-m-d", strtotime($date_from_db));
                                        $get_added_tasks = $connection->query("SELECT * FROM doc_daily_tasks WHERE doctor_id = '$doc_id' AND `status` = 'Pending....'");
                                        if ($get_added_tasks->num_rows < 1) {
                                        ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No Task Added Yet</td>
                                            </tr>
                                    </table>
                                    <p>Showing 0 to 0 of 0 entities.</p>
                                <?php
                                        }
                                        foreach ($get_added_tasks as $task => $row) {
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row['task']; ?></td>
                                        <td><?= $row['task_time']; ?></td>
                                        <td><?= $row['status']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTask<?= $task; ?>"> Edit </button>
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#doneTask<?= $task; ?>"> Done </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTask<?= $task; ?>"> Delete </button>
                                        </td>
                                        <!-- modal for edit task  -->
                                        <div class="modal fade" id="editTask<?= $task; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Task</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                        if (isset($_POST['edit_task'])) {
                                                            $doctor_id = $_POST['doctor_id'];
                                                            $task = $_POST['task'];
                                                            $time = $_POST['time'];
                                                            $id = $_POST['id'];
                                                            $edit_task = $connection->query("UPDATE `doc_daily_tasks` SET `doctor_id`='$doctor_id',`task`='$task',`task_time`='$time',`status`='Pending....' WHERE id = '$id'");
                                                            if ($edit_task) {
                                                                $_SESSION['edit_task'] = "Editted Successfully";
                                                            }
                                                        }
                                                        ?>
                                                        <form action="" method="post">
                                                            <div class="form-group my-3">
                                                                <label for="task" class="form-label">Edit Task</label>
                                                                <input type="text" name="task" id="task" value="<?= $row['task']; ?>" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="hidden" name="doctor_id" value="<?= $doc_id; ?>" class="form-control">
                                                                <input type="hidden" name="id" value="<?= $row['id']; ?>" class="form-control">
                                                            </div>
                                                            <div class="form-group my-3">
                                                                <label for="time" class="form-label">Set Task Time</label>
                                                                <input type="time" name="time" id="time" class="form-control" required>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="edit_task" class="btn btn-primary">Submit</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal for done task  -->
                                        <div class="modal fade" id="doneTask<?= $task; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Done Task</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-success">
                                                        <p>Are you sure this task is done ?</p>
                                                        <?php
                                                        if (isset($_POST['done_task'])) {
                                                            $id = $_POST['id'];

                                                            $done_task = $connection->query("UPDATE doc_daily_tasks SET `status` = 'Done' WHERE id = '$id'");
                                                            if ($done_task) {
                                                                $_SESSION['done_task'] = "Done Successfully";
                                                            }
                                                        }
                                                        ?>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="done_task" class="btn btn-primary">Yes</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal for deleting task  -->
                                        <div class="modal fade" id="deleteTask<?= $task; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Task</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-danger">
                                                        <p>Are you sure you want to delete this task?</p>
                                                        <?php
                                                        if (isset($_POST['delete_task'])) {
                                                            $id = $_POST['id'];

                                                            $done_task = $connection->query("DELETE FROM doc_daily_tasks WHERE id = '$id'");
                                                            if ($done_task) {
                                                                $_SESSION['delete_task'] = "Deleted Successfully";
                                                            }
                                                        }
                                                        ?>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="delete_task" class="btn btn-primary">Yes</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
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
                        </div>
                    </div>

                <?php
                }
                if ($page == 'chats') {
                ?>
                    <div class="container-main">
                        <div class="left-side">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action bg-primary  text-left text-white">chats</a>
                            </div>
                        </div>
                        <div class="right-side">
                            <div class="top-navbar-hd">
                                p
                            </div>

                            <div class="main-content2">
                                kk
                            </div>

                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/alertify/alertify.min.js"></script>
    <!-- search  -->
    <script>
        $(document).ready(function() {
            $("#searchbar").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#cat tr").filter(function() {
                    $(this).toggle($(this).text()
                        .toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <!-- success and failure messages  -->
    <?php
    if (isset($_SESSION["update"])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION["update"]; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=myprofile";
            }, 3000);
        </script>
    <?php
        unset($_SESSION["update"]);
    }
    ?>
    <?php
    if (isset($_SESSION['done_task'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['done_task']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=daily_tasks";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['done_task']);
    }
    ?>
    <?php
    if (isset($_SESSION['done_task'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['done_task']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=daily_tasks";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['done_task']);
    }
    ?>
    <?php
    if (isset($_SESSION['delete_task'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['delete_task']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=daily_tasks";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['delete_task']);
    }
    ?>
    <?php
    if (isset($_SESSION['delete_prescription'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['delete_prescription']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=prescriptions";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['delete_prescription']);
    }
    ?>
    <?php
    if (isset($_SESSION['add_prescriptions'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['add_prescriptions']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=prescriptions";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['add_prescriptions']);
    }
    ?>
    <?php
    if (isset($_SESSION['add_task'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['add_task']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=daily_tasks";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['add_task']);
    }
    ?>
    <?php
    if (isset($_SESSION['edit_task'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['edit_task']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=daily_tasks";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['edit_task']);
    }
    ?>
    <?php
    if (isset($_SESSION['admit_patient'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['admit_patient']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=inpatients";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['admit_patient']);
    }
    ?>
    <?php
    if (isset($_SESSION['test_patient'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['test_patient']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=lab_test_results";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['test_patient']);
    }
    ?>
    <?php
    if (isset($_SESSION['discharge_patient'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['discharge_patient']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=inpatients";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['discharge_patient']);
    }
    ?>
    <?php
    if (isset($_SESSION['$doctor_reply'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['$doctor_reply']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=appointments";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['$doctor_reply']);
    }
    ?>
    <?php
    if (isset($_SESSION['appointment_status_done'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['appointment_status_done']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=upcomming_appointments";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['appointment_status_done']);
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