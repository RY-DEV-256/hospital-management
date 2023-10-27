<?php
session_start();
include("parts/db-con.php");
$doc_username = "";
$doc_password = "";
$page = $_REQUEST['page'] ?? 'patient';
?>
<?php
include("parts/header.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 left-side">
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="links nav-justified d-flex text-center bg-primary rounded mt-3 p-2">
                            <a href="index.php?page=patient" class="nav-link active me-3 a">Patient</a>
                            <a href="index.php?page=doctor" class="nav-link me-3 a">Doctor</a>
                            <a href="index.php?page=admin" class="nav-link a">Admin</a>
                            <!-- <a href="index.php?page=job" class="nav-link a">Jobs</a> -->
                        </div>
                    </div>
                    <div class="col-md-3"></div>

                </div>
                <div class="mt-3">
                    <?php
                    if ($page == 'patient') {
                    ?>
                        <?php

                        $sql = $connection->query("SELECT * FROM patients");
                        $row = $sql->fetch_assoc();

                        $taken_email = $row["email"];

                        if (isset($_POST["register"])) {
                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $email = $_POST['email'];
                            $gender = $_POST['gender'];
                            $phone = $_POST['phone'];
                            $dob = $_POST['dob'];
                            $location = $_POST['location'];
                            $password = $_POST['pass'];
                            $cpassword = $_POST['cpass'];

                            $error = array();
                            if (empty($fname)) {
                                $error['error'] = "Enter First Name !";
                            } else if (empty($lname)) {
                                $error["error"] = "Enter Last Name !";
                            } else if (empty($email)) {
                                $error["error"] = "Enter Email !";
                            } else if ($email == $taken_email) {
                                $error["error"] = "Use A Unique Email !";
                            } else if (empty($phone)) {
                                $error["error"] = "Enter Phone Number !";
                            } else if (empty($dob)) {
                                $error["error"] = "Enter Date Of Birth !";
                            } else if (empty($location)) {
                                $error["error"] = "Enter Current Location !";
                            } else if (empty($password)) {
                                $error["error"] = "Enter Password !";
                            } else if (strlen($password) < 6) {
                                $error["error"] = "Password Must have 6 digits !";
                            } else if (empty($cpassword)) {
                                $error["error"] = "Confirm Password !";
                            } else if ($password != $cpassword) {
                                $error["error"] = "Passwords Not Matching !";
                            } else {
                                $reg_patient = $connection->query("INSERT INTO patients ( first_name, last_name, gender, date_of_birth, email, phone, `password`, `location`) VALUES ('$fname','$lname','$gender','$dob','$email','$phone','$password','$location')");
                                if ($reg_patient) {
                                    $_SESSION['success'] = "Registered Successfully";
                                }
                            }
                        }

                        ?>
                        <form method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded" style="border-radius:10px;">
                            <h5 class="text-center">Register As A Patient</h5>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label>First Name</label>
                                            <input type="text" name="fname" placeholder="Enter Your First Name" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label>Last Name</label>
                                            <input type="text" name="lname" placeholder="Enter Your Last Name" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12  my-2">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <div class="maxl">
                                        <label class="radio inline">
                                            <input type="radio" name="gender" value="Male" checked>
                                            <span> Male </span>
                                        </label>
                                        <label class="radio inline">
                                            <input type="radio" name="gender" value="Female">
                                            <span>Female </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label>Email</label>
                                            <input type="email" name="email" placeholder="Enter Your Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone" placeholder="Enter Your Phone Number" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label>Date Of Birth</label>
                                            <input type="date" name="dob" value="<?php if (isset($_POST['dob'])) echo $_POST['dob']; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label>Location</label>
                                            <input type="text" name="location" placeholder="Enter Your Current Location" value="<?php if (isset($_POST['location'])) echo $_POST['location']; ?>" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label>Password</label>
                                            <input type="password" id="password" name="pass" placeholder="Enter Your Password" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label>Confirm Password</label>
                                            <input type="password" name="cpass" placeholder="Confirm Your Password" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <input type="checkbox" onclick="myFunction()" style="width:16px;height:16px;">&nbsp; Show Password
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <input type="submit" value="Register" name="register" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="form-group my-2 text-center">
                                    <a href="patient-login.php" class="nav-link text-primary my-2">Already have
                                        an account?</a>
                                </div>
                            </div>

                        </form>
                    <?php
                    }
                    if ($page == 'doctor') {
                    ?>
                        <?php

                        $doctor_info = $connection->query('SELECT * FROM doctors');

                        while ($row_doctor = $doctor_info->fetch_assoc()) {
                            $doc_username = $row_doctor['username'];
                            $doc_password = $row_doctor['password'];
                        }

                        if (isset($_POST['doctor_login'])) {
                            $username = $_POST['uname'];
                            $password = $_POST['pass'];


                            $error = array();


                            if (empty($username)) {
                                $error['error'] = 'Enter Doctor Username !';
                            } else if (empty($password)) {
                                $error['error'] = 'Enter Doctor Password !';
                            } else if ($username != $doc_username || $password != $doc_password) {
                                $error['error'] = 'Invalid Password or Username!';
                            }
                            if ($username == $doc_username and $password == $doc_password) {

                                $_SESSION['dlogin_success'] = "Logged in successfully";
                                $_SESSION['doctor'] = "$username";
                            }
                        }
                        ?>
                        <form action="" method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded" style="border-radius:10px;">
                            <h5 class="text-center">Login As A Doctor</h5>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label>Username</label>
                                            <input type="text" name="uname" value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>" placeholder="Enter Doctor Username" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label>Password</label>
                                            <input type="password" id="password" name="pass" placeholder="Enter Doctor Password" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <input type="checkbox" onclick="myFunction()" style="width:16px;height:16px;">&nbsp; Show Password
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <input type="submit" value="Login" name="doctor_login" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    <?php
                    }
                    if ($page == 'admin') {
                    ?>
                        <?php
                        $admin_info = $connection->query("SELECT * FROM `admin`");
                        while ($row_admin = $admin_info->fetch_assoc()) {
                            $admin_username = $row_admin["username"];
                            $admin_password = $row_admin["password"];
                        }
                        if (isset($_POST["admin_login"])) {
                            $username_admin = $_POST["uname"];
                            $password_admin = $_POST["pass"];

                            $error = array();
                            if (empty($username_admin)) {
                                $error["error"] = "Enter Admin Username !";
                            } else if (empty($password_admin)) {
                                $error["error"] = "Enter Admin Password";
                            } else if ($username_admin != $admin_username || $password_admin != $admin_password) {
                                $error["error"] = "Invalid Username or Password";
                            }

                            if ($username_admin == $admin_username and $password_admin == $admin_password) {
                                $_SESSION['admin_login_success'] = "Logged in successfully";
                                $_SESSION['admin'] = $admin_username;
                            }
                        }
                        ?>
                        <form action="" method="post" class="shadow p-3 mb-5 bg-body-tertiary rounded" style="border-radius:10px;">
                            <h5 class="text-center">Login As An Admin</h5>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label>Username</label>
                                            <input type="text" name="uname" value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>" placeholder="Enter Admin Username" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label>Password</label>
                                            <input type="password" id="password" name="pass" placeholder="Enter Admin Password" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <input type="checkbox" onclick="myFunction()" style="width:16px;height:16px;">&nbsp; Show Password
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <input type="submit" value="Login" name="admin_login" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    <?php
                    }

                    ?>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
include("parts/footer.php");
?>