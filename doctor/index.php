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
                if ($page == 'myprofile') {
                ?>
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row mt-3">
                                <div class="col-md-6 shadow p-3 mb-5 bg-body-tertiary rounded">
                                    <?php
                                    include("../parts/db-con.php");
                                    $doc_id = $_SESSION["id"];
                                    $profile = $connection->query("SELECT * FROM doctors WHERE doctor_id = $doc_id");
                                    $profile_row = $profile->fetch_assoc();
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
                                                <?= $profile_row['department']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-5 shadow p-3 mb-5 bg-body-tertiary rounded">
                                    <form action="" method="post">
                                    <h5 class="text-center my-3">Edit Profile</h5>
                                    <div class="form-group-my-3">
                                        <label class="form-label" for="profile">Change Profile Picture</label>
                                        <input type="file" name="profile" id="profile" class="form-control">
                                    </div>
                                    <div class="form-group-my-3">
                                        <label class="form-label" for="username">Change Username</label>
                                        <input type="text" name="username" id="username" value="<?= $profile_row['username']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group-my-3">
                                        <label class="form-label" for="address">Change Address</label>
                                        <input type="text" name="address" id="address" value="<?= $profile_row['address']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group-my-3">
                                        <label class="form-label" for="phone">Change Phone Number</label>
                                        <input type="text" name="phone" id="phone" value="<?= $profile_row['phone_number']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group-my-3">
                                        <label class="form-label" for="email">Change Email</label>
                                        <input type="email" name="email" id="email" value="<?= $profile_row['email']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group-my-3">
                                        <label class="form-label" for="password">Change Password</label>
                                        <input type="password" name="password" id="password" placeholder="Enter Old Password" class="form-control">
                                    </div>
                                    <div class="form-group-my-3">
                                        <label class="form-label" for="cpassword">Change Password</label>
                                        <input type="password" name="cpassword" id="cpassword" placeholder="Enter New Password" class="form-control">
                                    </div>
                                    <div class="form-group my-3">
                                    <input type="submit" value="Edit" name="edit_profile" class="btn btn-primary">
                                    </div>
                                    </form>
                                </div>
                                
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
</body>

</html>