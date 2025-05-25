<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <!-- <base href="../../../"> -->
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="images/favicon.png">
    <!-- Page Title  -->
    <title>Register | Messwale</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="assets/css/dashlite.css?ver=3.2.2">
    <link id="skin-default" rel="stylesheet" href="assets/css/theme.css?ver=3.2.2">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="html/index.html" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="images/messwale.png" srcset="images/messwale.png 2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="images/messwale.png" srcset="images/messwale.png 2x" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Register</h4>
                                        <div class="nk-block-des">
                                            <p>Create New Student Account</p>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" action="register.php">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Name</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="full_name" name="full_name" placeholder="Enter your name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Enter your email address ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your passcode">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="rill_number">Roll No</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="roll_number" name="roll_number" placeholder="Enter your roll no ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="course">Course</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="course" name="course" placeholder="Enter course">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="address">Address</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="address" name="address" placeholder="Enter your address ">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="default-06">Gender</label>
                                        <div class="form-control-wrap ">
                                            <div class="form-control-select">
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="male">Male</option>
                                                    <option value="female">female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4"> Already have an account? <a href="login.php"><strong>log in instead</strong></a>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="assets/js/bundle.js?ver=3.2.2"></script>
    <script src="assets/js/scripts.js?ver=3.2.2"></script>
    <script src="assets/js/example-sweetalert.js?ver=3.2.2"></script>

</html>


<?php
include 'config.php';
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $hashedPassword = hashPassword($password);
    $role = 'student';
    $full_name = sanitizeInput($_POST['full_name']);
    $roll_number = sanitizeInput($_POST['roll_number']);
    $course = sanitizeInput($_POST['course']);
    $address = sanitizeInput($_POST['address']);
    $gender = sanitizeInput($_POST['gender']);

    // $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashedPassword', '$role')";
    // pg_query($pdo, $sql);
    $user_id = '';

    // if ($role == 'admin') {
    //     $sql = "INSERT INTO admins (user_id, full_name, address, gender) VALUES ($user_id, '$full_name', '$address', '$gender')";
    //     pg_query($pdo, $sql);
    //     echo 'data inserted';
    // } else {

        $sql = "INSERT INTO students (full_name, roll_number,gender, address,course,email,pasword,role) VALUES ('$full_name', '$roll_number', '$gender', '$address', '$course','$email','$password','$role')";
        $result=pg_query($sql);
        if ($result) {
            echo '<script type="text/javascript"> Swal.fire("Registration Successful done"); setTimeout(function() { window.location.href = "login.php" }, 1000);</script>';
            
        } else {
            echo '<script type="text/javascript"> Swal.fire("please try again");</script>';
        }
        //echo '';
    //}

    //header("Location:login.php");
    //exit();
}
?>
   
