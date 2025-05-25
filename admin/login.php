<?php session_start();?>


<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <!-- <base href="../../../"> -->
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="../images/favicon.png">
    <!-- Page Title  -->
    <title>Admin Login | Messwale</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="../assets/css/dashlite.css?ver=3.2.2">
    <link id="skin-default" rel="stylesheet" href="../assets/css/theme.css?ver=3.2.2">
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
                                <img class="logo-light logo-img logo-img-lg" src="../images/messwale.png" srcset="../images/messwale.png 2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="../images/messwale.png" srcset="../images/messwale.png 2x" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title"> Admin Login</h4>
                                        <div class="nk-block-des">
                                            <p>login into Account</p>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" action="login.php">
                                   
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
                                            <input type="password" class="form-control form-control-lg" id="pass" name="pass" placeholder="Enter your passcode">
                                        </div>
                                    </div>

                                   
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                                    </div>
                                </form>

                               
                                <div class="form-note-s2 text-center pt-4"> Dont have an account? <a href="register.php"><strong>register in instead</strong></a>
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
    <script src="../assets/js/bundle.js?ver=3.2.2"></script>
    <script src="../assets/js/scripts.js?ver=3.2.2"></script>
    <script src="../assets/js/example-sweetalert.js?ver=3.2.2"></script>

</html>


<?php
//session_start();
include '../config.php';
include '../functions.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //echo 'hello';
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['pass']);
    //echo $email ;

    //$sql = "SELECT * FROM students WHERE email = '$email'";
    // $sql = ;
    
    $result = pg_query("SELECT * FROM admins WHERE email = '$email' ");
    //echo $result;
    // if (!$result) {
    //     die("Error in SQL query: " . pg_last_error());
    // } else {
    //     header("Location: login.php");
    //     exit();
    // }
    
    
    $user = pg_fetch_assoc($result);
    //echo $user['full_name'];
   
    if ( $user && $email==$user['email'] && $password==$user['pass'] ) {
        //session_start();
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        // $_SESSION['role'] = $user['role'];
        echo  $_SESSION['admin_id'];
        echo '<script type="text/javascript"> Swal.fire("login Success"); setTimeout(function() { window.location.href = "admin_dashboard.php" }, 3000);</script>';
       
       
        }
 else {
    echo '<script type="text/javascript"> Swal.fire("Invalid email or password");</script>';
        //header("Location: login.php");
            //exit();
    }
}
    


if (isset($_GET['action']) && $_GET['action'] == 'forgot') {
    // Code to handle forgot password, send reset link via email
}
?>