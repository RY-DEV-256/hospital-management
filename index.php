<?php
session_start();
include("parts/db-con.php");
$doc_username = "";
$doc_password = "";
$doc_id = "";
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
                    <div class="col-md-6 text-center">
                        <div class="btn-group mt-3">
                            <a href="index.php?page=patient" class="btn btn-primary">Patient</a>
                            <a href="index.php?page=doctor" class="btn btn-primary">Doctor</a>
                            <a href="index.php?page=admin" class="btn btn-primary">Admin</a>
                        </div>
                    </div>
                    <div class="col-md-3"></div>

                </div>
                <div class="mt-3">
                    <?php
                    if ($page == 'patient') {
                    ?>
                        <?php

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
                        <form method="post" class="shadow p-3 mb-5 rounded">
                            <h5 class="text-center">Register As A Patient</h5>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label class="form-label">First Name</label>
                                            <input type="text" name="fname" placeholder="Enter Your First Name" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" name="lname" placeholder="Enter Your Last Name" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12  my-2">
                                <div class="form-group">
                                    <label class="form-label">Choose Gender</label>
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
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" placeholder="Enter Your Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" name="phone" placeholder="Enter Your Phone Number" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label class="form-label">Date Of Birth</label>
                                            <input type="date" name="dob" value="<?php if (isset($_POST['dob'])) echo $_POST['dob']; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" placeholder="Enter Your Current Location" value="<?php if (isset($_POST['location'])) echo $_POST['location']; ?>" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label class="form-label">Password</label>
                                            <input type="password" id="password" name="pass" placeholder="Enter Your Password" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label class="form-label">Confirm Password</label>
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
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                            <?php
                        if (isset($_POST['doctor_login'])) {
                            $username = $_POST['uname'];
                            $password = $_POST['pass'];

                            $error = array();

                            if (empty($username)) {
                                $error['error'] = 'Enter Doctor Username !';
                            } else if (empty($password)) {
                                $error['error'] = 'Enter Doctor Password !';
                            } else {
                                $doctor_info = $connection->query("SELECT * FROM doctors WHERE username = '$username' AND `password` = '$password'");

                                while ($row_doctor = $doctor_info->fetch_assoc()) {
                                    $doc_username = $row_doctor['username'];
                                    $doc_password = $row_doctor['password'];
                                    $doc_id = $row_doctor['doctor_id'];
                                }
                                if ($username == $doc_username and $password == $doc_password) {

                                    $_SESSION['dlogin_success'] = "Logged in successfully";
                                    $_SESSION['doctor'] = $username;
                                    $_SESSION["id"] = $doc_id;
                                } else {
                                    $error["error"] = "Invalid Username or Password";
                                }
                            }
                        }
                        ?>
                        <form action="" method="post" class="shadow p-3 mb-5  rounded">
                            <h5 class="text-center">Login As A Doctor</h5>
                                        <div class="form-group my-2">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="uname" value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>" placeholder="Enter Doctor Username" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="form-label">Password</label>
                                            <input type="password" id="password" name="pass" placeholder="Enter Doctor Password" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group my-2">
                                            <input type="checkbox" onclick="myFunction()" style="width:16px;height:16px;">&nbsp; Show Password
                                        </div>
                                        <div class="form-group my-2">
                                            <input type="submit" value="Login" name="doctor_login" class="btn btn-primary form-control">
                                        </div>

                        </form>
                    
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <?php
                    }
                    if ($page == 'pharmacy') {
                    ?>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                            <?php
                        if (isset($_POST['doctor_login'])) {
                            $username = $_POST['uname'];
                            $password = $_POST['pass'];

                            $error = array();

                            if (empty($username)) {
                                $error['error'] = 'Enter Doctor Username !';
                            } else if (empty($password)) {
                                $error['error'] = 'Enter Doctor Password !';
                            } else {
                                $doctor_info = $connection->query("SELECT * FROM doctors WHERE username = '$username' AND `password` = '$password'");

                                while ($row_doctor = $doctor_info->fetch_assoc()) {
                                    $doc_username = $row_doctor['username'];
                                    $doc_password = $row_doctor['password'];
                                    $doc_id = $row_doctor['doctor_id'];
                                }
                                if ($username == $doc_username and $password == $doc_password) {

                                    $_SESSION['dlogin_success'] = "Logged in successfully";
                                    $_SESSION['doctor'] = $username;
                                    $_SESSION["id"] = $doc_id;
                                } else {
                                    $error["error"] = "Invalid Username or Password";
                                }
                            }
                        }
                        ?>
                        <form action="" method="post" class="shadow p-3 mb-5  rounded">
                            <h5 class="text-center">Login As A Pharmacist Doctor</h5>
                                        <div class="form-group my-2">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="uname" value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>" placeholder="Enter Doctor Username" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="form-label">Password</label>
                                            <input type="password" id="password" name="pass" placeholder="Enter Doctor Password" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group my-2">
                                            <input type="checkbox" onclick="myFunction()" style="width:16px;height:16px;">&nbsp; Show Password
                                        </div>
                                        <div class="form-group my-2">
                                            <input type="submit" value="Login" name="doctor_login" class="btn btn-primary form-control">
                                        </div>

                        </form>
                    
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <?php
                    }
                    if ($page == 'laboratory') {
                    ?>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                            <?php
                        if (isset($_POST['doctor_login'])) {
                            $username = $_POST['uname'];
                            $password = $_POST['pass'];

                            $error = array();

                            if (empty($username)) {
                                $error['error'] = 'Enter Doctor Username !';
                            } else if (empty($password)) {
                                $error['error'] = 'Enter Doctor Password !';
                            } else {
                                $doctor_info = $connection->query("SELECT * FROM doctors WHERE username = '$username' AND `password` = '$password'");

                                while ($row_doctor = $doctor_info->fetch_assoc()) {
                                    $doc_username = $row_doctor['username'];
                                    $doc_password = $row_doctor['password'];
                                    $doc_id = $row_doctor['doctor_id'];
                                }
                                if ($username == $doc_username and $password == $doc_password) {

                                    $_SESSION['dlogin_success'] = "Logged in successfully";
                                    $_SESSION['doctor'] = $username;
                                    $_SESSION["id"] = $doc_id;
                                } else {
                                    $error["error"] = "Invalid Username or Password";
                                }
                            }
                        }
                        ?>
                        <form action="" method="post" class="shadow p-3 mb-5  rounded">
                            <h5 class="text-center">Login As A Pathologist Doctor</h5>
                                        <div class="form-group my-2">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="uname" value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>" placeholder="Enter Doctor Username" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group my-2">
                                            <label class="form-label">Password</label>
                                            <input type="password" id="password" name="pass" placeholder="Enter Doctor Password" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group my-2">
                                            <input type="checkbox" onclick="myFunction()" style="width:16px;height:16px;">&nbsp; Show Password
                                        </div>
                                        <div class="form-group my-2">
                                            <input type="submit" value="Login" name="doctor_login" class="btn btn-primary form-control">
                                        </div>

                        </form>
                    
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <?php
                    }
                    if ($page == 'admin') {
                    ?>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                            <?php
                        $admin_info = $connection->query("SELECT * FROM `admin`");
                        while ($row_admin = $admin_info->fetch_assoc()) {
                            $admin_username = $row_admin["username"];
                            $admin_password = $row_admin["password"];
                            $admin_id = $row_admin['id'];
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
                                $_SESSION['admin_id'] = $admin_id;
                            }
                        }
                        ?>
                        <form action="" method="post" class="shadow p-3 mb-5  rounded">
                            <h5 class="text-center">Login As Admin</h5>
                            
                                        <div class="form-group my-2">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="uname" value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>" placeholder="Enter Admin Username" autocomplete="off" class="form-control">
                                        </div>
                                   
                                        <div class="form-group my-2">
                                            <label class="form-label">Password</label>
                                            <input type="password" id="password" name="pass" placeholder="Enter Admin Password" autocomplete="off" class="form-control">
                                        </div>
                               
                           
                                        <div class="form-group my-2">
                                            <input type="checkbox" onclick="myFunction()" style="width:16px;height:16px;">&nbsp; Show Password
                                        </div>
                                    
                                        <div class="form-group my-2">
                                            <input type="submit" value="Login" name="admin_login" class="btn btn-primary form-control">
                                        </div>
                              
                        </form>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                        
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