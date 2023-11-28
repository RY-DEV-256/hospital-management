<?php
session_start();
include("parts/db-con.php");
$patient_email = "";
$patient_password = "";
include("parts/header.php");

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 left-side">
        </div>
        <div class="col-md-6 mt-5">
            <!-- php script for Login As A Patient  -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <?php
                        if (isset($_POST['patient_login'])) {
                            $email = $_POST['email'];
                            $password = $_POST['pass'];

                            $error = array();
                            if (empty($email)) {
                                $error['error'] = 'Enter Your Email !';
                            } else if (empty($password)) {
                                $error['error'] = 'Enter Your Password !';
                            } else {
                                $patient_info = $connection->query("SELECT * FROM patients WHERE email = '$email' AND `password` = '$password'");
                                while ($patient = $patient_info->fetch_assoc()) {
                                    $patient_email = $patient['email'];
                                    $patient_password = $patient['password'];
                                    $patient_id = $patient['patient_id'];
                                }
                                if ($email == $patient_email and $password == $patient_password) {
                                    $_SESSION['patient_login_success'] = "Logged in successfully";
                                    $_SESSION['patient'] = $email;
                                    $_SESSION['patient_id'] = $patient_id;

                                } else {
                                    $error['error']  = "Invalid Email or Password";
                                }
                            }
                        }
                        ?>
                        <form method="post" class="shadow p-3 mb-5  rounded">
                            <h5 class="text-center">Login As A Patient</h5>
                            <div class="form-group my-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Enter Your Email" autocomplete="off" class="form-control">
                            </div>

                            <div class="form-group my-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="pass" placeholder="Enter Your Password" autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group my-2">
                                <input type="checkbox" onclick="myFunction()" style="width:16px;height:16px;">&nbsp; Show Password
                            </div>
                            <div class="form-group my-2">
                                <input type="submit" value="Login" name="patient_login" class="btn btn-primary form-control">
                            </div>

                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>



        </div>
    </div>
</div>
</div>

<?php
include("parts/footer.php");
?>