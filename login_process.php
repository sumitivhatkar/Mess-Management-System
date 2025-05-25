<?php
session_start();
include 'config.php';
include 'functions.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo 'hello';
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    //echo $email ;

    //$sql = "SELECT * FROM students WHERE email = '$email'";
    // $sql = ;
    
    $result = pg_query("SELECT * FROM students WHERE email = '$email' ");
    echo $result;
    // if (!$result) {
    //     die("Error in SQL query: " . pg_last_error());
    // } else {
    //     header("Location: login.php");
    //     exit();
    // }
    
    
    $user = pg_fetch_assoc($result);
    //echo $user['full_name'];
   
    if ($email==$user['email'] && $password==$user['pasword'] ) {
        $_SESSION['id'] = $user['id'];
        // $_SESSION['role'] = $user['role'];
        echo 'chngaing';
        header("Location: student_panel.php");
            exit();
       
        }
 else {
        $error = "Invalid username/email or password";
        header("Location: login.php");
            exit();
    }
}
    


if (isset($_GET['action']) && $_GET['action'] == 'forgot') {
    // Code to handle forgot password, send reset link via email
}
?>
