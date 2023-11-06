<?php
session_start();
$page = $_REQUEST['page'] ?? 'dashboard';

include("../parts/db-con.php");
if (!isset($_SESSION['admin'])) {
    header("location:../index.php");
    exit();
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
    <link rel="stylesheet" href="../assets/alertify/alertify.min.css">
    <link rel="stylesheet" href="../assets/alertify/default.min.css">
    <link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
    <div class="container-main">
        <div class="left-side bg-success">
            <div class="welcome">
            </div>
            <div class="list-group">
                <a href="index.php?page=dashboard" class="list-group-item list-group-item-action bg-success  text-left text-white">Dashboard</a>
                <a href="index.php?page=patients" class="list-group-item list-group-item-action bg-success  text-left text-white">Patients</a>
                <a href="index.php?page=inpatients" class="list-group-item list-group-item-action bg-success  text-left text-white">Inpatients</a>
                <a href="index.php?page=outpatients" class="list-group-item list-group-item-action bg-success  text-left text-white">Outpatients</a>
                <a href="index.php?page=doctors" class="list-group-item list-group-item-action bg-success  text-left text-white">Doctors</a>
                <a href="index.php?page=staff" class="list-group-item list-group-item-action bg-success  text-left text-white">Staff</a>
                <a href="index.php?page=departments" class="list-group-item list-group-item-action bg-success  text-left text-white">Departments</a>
                <a href="index.php?page=rooms" class="list-group-item list-group-item-action bg-success  text-left text-white">Rooms</a>
                <a href="index.php?page=payments" class="list-group-item list-group-item-action bg-success  text-left text-white">Payments</a>
                <a href="index.php?page=daily_tasks" class="list-group-item list-group-item-action bg-success  text-left text-white">Daily Tasks</a>
                <a href="index.php?page=profile" class="list-group-item list-group-item-action bg-success text-left text-white">Admin Profile</a>
                <a href="index.php?page=meetings" class="list-group-item list-group-item-action bg-success  text-left text-white">Meetings</a>
            </div>
        </div>
        <div class="right-side">
            <nav class="navbar navbar-expand-sm bg-white top-navbar-hd">
                <div class="top-navbar-content p-3">
                    <div class="nav-page text-success mt-1"><?php
                                                            if ($page == 'dashboard') {
                                                                echo "Dashboard";
                                                            } else if ($page == 'patients') {
                                                                echo "Patients";
                                                            } else if ($page == 'inpatients') {
                                                                echo "Inpatients";
                                                            } else if ($page == 'outpatients') {
                                                                echo "Outpatients";
                                                            } else if ($page == 'doctors') {
                                                                echo "Doctors";
                                                            } else if ($page == 'staff') {
                                                                echo "Staff Members";
                                                            } else if ($page == 'departments') {
                                                                echo "Departments";
                                                            } else if ($page == 'rooms') {
                                                                echo "Rooms";
                                                            } else if ($page == 'daily_tasks') {
                                                                echo "Daily Tasks";
                                                            } else if ($page == 'payments') {
                                                                echo "Payments";
                                                            } else if ($page == 'profile') {
                                                                echo "My Profile";
                                                            } else if ($page == 'meetings') {
                                                                echo "Meetings";
                                                            } else if ($page == 'edit_patient') {
                                                                echo "Edit Patient' Details";
                                                            } else if ($page == 'add_doctor') {
                                                                echo "Add New Doctor";
                                                            }
                                                            ?></div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navLinks"><span><i class="navbar-toggler-icon"></i></span></button>
                    <div class="collapse navbar-collapse" id="navLinks">
                        <ul class="navbar-nav ms-auto">
                            <li>
                                <a href="" class="nav-link text-success me-3">Chats<sup class="text-danger">1</sup></a>
                            </li>
                            <li>
                                <button type="button" class="btn bg-success text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                                <form action="admin_logout.php" method="post">
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
                if ($page == 'patients') {
                ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">

                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $i = 1;
                                    $pateints = $connection->query("SELECT * FROM patients");
                                    if ($pateints->num_rows < 1) {
                                    ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No Patients Yet</td>
                                        </tr>
                                </table>
                            <?php
                                    }
                                    foreach ($pateints as $index => $row) {
                                        $patient_id = $row['patient_id'];
                            ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $row['first_name']; ?></td>
                                    <td><?= $row['last_name']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $row['phone']; ?></td>
                                    <td><?= $row['location']; ?></td>
                                    <td class="d-flex">
                                        <a href="index.php?page=edit_patient&patient_id=<?= $patient_id; ?>" class="btn btn-primary me-2">Edit</a>
                                        <!-- Button trigger modal -->
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePatient<?= $index; ?>">Delete</button>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deletePatient<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Patient</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h6>Are you sure you want to delete <?= $row['first_name']; ?> <?= $row['last_name']; ?> ?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <?php
                                                    if (isset($_POST['delete_patient'])) {
                                                        $patient_id = $_POST['id'];
                                                        $delete = $connection->query("DELETE FROM patients WHERE patient_id = '$patient_id'");
                                                        if ($delete) {
                                                            $_SESSION['delete'] = "Deleted Successfully";
                                                        }
                                                    }
                                                    ?>
                                                    <form method="post">
                                                        <input type="hidden" name="id" value="<?= $patient_id; ?>">
                                                        <button type="submit" name="delete_patient" class="btn btn-primary">Yes</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                <?php
                }
                if ($page == 'inpatients') {
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
                if ($page == 'outpatients') {
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
                if ($page == 'doctors') {
                ?>
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Specialization</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php

                                        $i = 1;
                                        $doctor_info = $connection->query("SELECT do.doctor_id, do.first_name, do.last_name, do.specialization, do.email, do.phone_number, do.address, de.department_name FROM doctors do INNER JOIN departments de ON do.department_id = de.department_id");
                                        if ($doctor_info->num_rows < 1) {
                                        ?>
                                            <tr>
                                                <td colspan="6" class="text-center"></td>
                                            </tr>
                                    </table>
                                <?php
                                        }
                                        foreach ($doctor_info as $index => $row_doctor_info) {


                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row_doctor_info['first_name']; ?></td>
                                        <td><?= $row_doctor_info['last_name']; ?></td>
                                        <td><?= $row_doctor_info['specialization']; ?></td>
                                        <td><?= $row_doctor_info['department_name']; ?></td>
                                        <td>

                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewDoctor<?= $index; ?>">View</button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDoctor<?= $index; ?>">Delete</button>
                                        </td>
                                        <!-- Modal for deleting -->
                                        <div class="modal fade" id="deleteDoctor<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Patient</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Are you sure you want to delete Doctor <?= $row_doctor_info['first_name']; ?> <?= $row_doctor_info['last_name']; ?> ?</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php
                                                        if (isset($_POST['delete_doctor'])) {
                                                            $doctor_id = $_POST['id'];
                                                            $delete = $connection->query("DELETE FROM doctors WHERE doctor_id = '$doctor_id'");
                                                            if ($delete) {
                                                                $_SESSION['delete_doctor'] = "Deleted Successfully";
                                                            }
                                                        }
                                                        ?>
                                                        <form method="post">
                                                            <input type="hidden" name="id" value="<?= $row_doctor_info['doctor_id']; ?>">
                                                            <button type="submit" name="delete_doctor" class="btn btn-primary">Yes</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal for viewing doctor  -->
                                        <div class="modal fade" id="viewDoctor<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Doctor' Details</h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <h5 class="text-success">First Name : <span class="text-dark"><?= $row_doctor_info['first_name']; ?></span></h5>
                                                            <h5 class="text-success">Last Name : <span class="text-dark"><?= $row_doctor_info['last_name']; ?></span></h5>
                                                            <h5 class="text-success">Userame : <span class="text-dark"><?= $row_doctor_info['first_name']; ?></span></h5>
                                                            <h5 class="text-success">Email : <span class="text-dark"><?= $row_doctor_info['email']; ?></span></h5>
                                                            <h5 class="text-success">Phone Number : <span class="text-dark"><?= $row_doctor_info['phone_number']; ?></span></h5>
                                                            <h5 class="text-success">Specialization : <span class="text-dark"><?= $row_doctor_info['specialization']; ?></span></h5>
                                                            <h5 class="text-success">Department : <span class="text-dark"><?= $row_doctor_info['department_name']; ?></span></h5>
                                                            <h5 class="text-success">Address : <span class="text-dark"><?= $row_doctor_info['address']; ?></span></h5>
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
                                <div class="col-md-2">
                                    <a href="index.php?page=add_doctor" class="btn btn-primary">Add New Doctor</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                if ($page == 'staff') {
                ?>

                <?php
                }
                if ($page == 'departments') {
                ?>
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>#</th>
                                            <th>Department Name</th>
                                            <th>Action</th>
                                            <?php
                                            $i = 1;
                                            $department = $connection->query("SELECT * FROM departments");
                                            if ($department->num_rows < 1) {
                                            ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No Department Yet</td>
                                        </tr>
                                    </table>
                                <?php

                                            }
                                            foreach ($department as $index => $row) {
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row['department_name']; ?></td>
                                        <td class="d-flex">
                                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#viewDepartment<?= $index; ?>">View</button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDepartment<?= $index; ?>">Delete</button>
                                        </td>
                                        <!-- Modal for deleting dept -->
                                        <div class="modal fade" id="deleteDepartment<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Department</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h6>Are you sure you want to delete Department of <?= $row['department_name']; ?> ?</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <?php
                                                        if (isset($_POST['delete_dept'])) {
                                                            $dept_id = $_POST['id'];
                                                            $delete = $connection->query("DELETE FROM departments WHERE department_id = '$dept_id'");
                                                            if ($delete) {
                                                                $_SESSION['delete_dept'] = "Deleted Successfully";
                                                            }
                                                        }
                                                        ?>
                                                        <form method="post">
                                                            <input type="hidden" name="id" value="<?= $row['department_id']; ?>">
                                                            <button type="submit" name="delete_dept" class="btn btn-primary">Yes</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal for viewing dept  -->
                                        <div class="modal fade" id="viewDepartment<?= $index; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Department Details</h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <h5 class="text-success">Department Name : <span class="text-dark"><?= $row['department_name']; ?></span></h5>
                                                            <h5 class="text-center text-success mt-2 mb-2">Department Description</h5>
                                                            <p><?= $row['department_description']; ?></p>
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
                                </tr>

                                </table>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                     if (isset($_POST['add_department'])) {
                                        $dept_name = $_POST['name'];
                                        $description = $_POST['description'];
            
            
                                        $error = array();
            
            
                                        if (empty($dept_name)) {
                                            $error['error'] = 'Enter Department Name !';
                                        } else if (empty($description)) {
                                            $error['error'] = 'Enter Department Description !';
            
                                        }else{
                                          $add_dept = $connection->query("INSERT INTO departments (department_name, department_description) VALUES ('$dept_name','$description')");
                                          if($add_dept){
                                            $_SESSION["add_dept"] = "Added Successfully";
                                          }
                                        }
                                        
                                    }
                                     ?>
                                    <form action="" method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded" style="border-radius:10px;">
                                        <h5 class="text-center">Add New Department</h5>

                                        <div class="col-md-12">
                                            <div class="form-group my-2">
                                                <label>Department Name</label>
                                                <input type="text" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" autocomplete="off" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group my-2">
                                                <label>Department Description</label>
                                                <textarea name="description" autocomplete="off"  cols="30" rows="10" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <input type="submit" value="Add Department" name="add_department" class="btn btn-primary">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }

                if ($page == 'rooms') {
                }
                if ($page == 'payments') {
                }
                if ($page == 'daily_tasks') {
                }
                if ($page == 'profile') {
                }
                if ($page == 'meetings') {
                }
                if ($page == 'edit_patient') {
                    include("../parts/db-con.php");
                ?>

                    <?php
                    if (isset($_GET['patient_id'])) {
                        $patient_id = $_GET['patient_id'];
                        $patient = $connection->query("SELECT * FROM patients WHERE patient_id = $patient_id");
                        $patient_info = $patient->fetch_assoc();
                    }
                    if (isset($_POST['edit_patient'])) {
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $location = $_POST['location'];

                        $error = array();
                        if (empty($fname)) {
                            $error['error'] = "Enter First Name !";
                        } else if (empty($lname)) {
                            $error["error"] = "Enter Last Name !";
                        } else if (empty($email)) {
                            $error["error"] = "Enter Email !";
                        } else if (empty($phone)) {
                            $error["error"] = "Enter Phone Number !";;
                        } else if (empty($location)) {
                            $error["error"] = "Enter Current Location !";
                        } else {
                            $update_patient = $connection->query("UPDATE patients SET first_name = '$fname', last_name = '$lname', email = '$email', phone ='$phone',location = '$location' WHERE patient_id = $patient_id");
                            if ($update_patient) {
                                $_SESSION['update_pat'] = 'Updated Successfully';
                            }
                        }
                    }
                    ?>
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6 mt-5">
                                    <form method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded" style="border-radius:10px;">
                                        <h5 class="text-center mt-3 md-3">Edit Patient</h5>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <label>First Name</label>
                                                        <input type="text" name="fname" value="<?= $patient_info['first_name']; ?>" autocomplete="off" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <label>Last Name</label>
                                                        <input type="text" name="lname" value="<?= $patient_info['last_name']; ?>" autocomplete="off" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <label>Email</label>
                                                        <input type="email" name="email" value="<?= $patient_info['email']; ?>" autocomplete="off" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <label>Phone Number</label>
                                                        <input type="text" name="phone" value="<?= $patient_info['phone']; ?>" autocomplete="off" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <label>Location</label>
                                                        <input type="text" name="location" value="<?= $patient_info['location']; ?>" autocomplete="off" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 d-flex">
                                                    <div class="form-group my-2 me-2">
                                                        <input type="submit" value="Edit" name="edit_patient" class="btn btn-primary">
                                                    </div>

                                                    <div class="form-group my-2">
                                                        <a href="index.php?page=patients" class="btn btn-secondary">Back</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    </div>
                <?php

                }
                if ($page == 'add_doctor') {

                ?>
                    <?php

                    if (isset($_POST["add"])) {
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $spec = $_POST['spec'];
                        $dept = $_POST['dept'];
                        $address = $_POST['address'];


                        $error = array();
                        if (empty($fname)) {
                            $error['error'] = "Enter First Name !";
                        } else if (empty($lname)) {
                            $error["error"] = "Enter Last Name !";
                        } else if (empty($email)) {
                            $error["error"] = "Enter Email !";
                        } else if (empty($phone)) {
                            $error["error"] = "Enter Phone Number !";
                        } else if (empty($spec)) {
                            $error["error"] = "Enter Specailization !";
                        } else if (empty($address)) {
                            $error["error"] = "Enter Address !";
                        } else {
                            $add_doctor = $connection->query("INSERT INTO doctors ( first_name, username, `password`, last_name, email, phone_number, specialization, department_id, `address`) VALUES ('$fname', '$fname','$email','$lname','$email','$phone','$spec','$dept','$address')");
                            if ($add_doctor) {
                                $_SESSION['add_doctor'] = "Added Successfully";
                            } else {
                                $error["error"] = "Something went wrong";
                            }
                        }
                    }

                    ?>
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">

                                    <form method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded" style="border-radius:10px;">
                                        <h5 class="text-center">Add New Doctor</h5>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <label>First Name</label>
                                                        <input type="text" name="fname" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>" autocomplete="off" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <label>Last Name</label>
                                                        <input type="text" name="lname" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>" autocomplete="off" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <label>Email</label>
                                                        <input type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" autocomplete="off" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <label>Phone Number</label>
                                                        <input type="text" name="phone" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>" autocomplete="off" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <label>Specialization</label>
                                                        <input type="text" name="spec" value="<?php if (isset($_POST['spec'])) echo $_POST['spec']; ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <label>Select Department</label>
                                                        <select name="dept" class="form-control">
                                                            <?php
                                                            $department = $connection->query("SELECT * FROM departments");
                                                            while ($row_dept = $department->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?= $row_dept['department_id']; ?>"><?= $row_dept['department_name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group my-2">
                                                        <label>Address</label>
                                                        <input type="text" name="address" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>" autocomplete="off" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">

                                                <div class="col-md-6 d-flex">
                                                    <div class="form-group my-2">
                                                        <input type="submit" value="Add Doctor" name="add" class="btn btn-primary">
                                                        <a href="index.php?page=doctors" class="btn btn-secondary">Back</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                                <div class="col-md-2"></div>
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
    <?php
    if (isset($_SESSION['update_pat'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['update_pat']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=patients";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['update_pat']);
    }
    ?>
    <?php
    if (isset($_SESSION['delete'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['delete']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=patients";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['delete']);
    }
    ?>
    <?php
    if (isset($_SESSION['delete_doctor'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['delete_doctor']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=doctors";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['delete_doctor']);
    }
    ?>
    <?php
    if (isset($_SESSION['delete_dept'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['delete_dept']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=departments";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['delete_dept']);
    }
    ?>
    <?php
    if (isset($_SESSION['add_doctor'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['add_doctor']; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=doctors";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['add_doctor']);
    }
    ?>
    <?php
    if (isset($_SESSION["add_dept"])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION["add_dept"]; ?>');
            setTimeout(function() {
                window.location.href = "index.php?page=departments";
            }, 3000);
        </script>
    <?php
        unset($_SESSION["add_dept"]);
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