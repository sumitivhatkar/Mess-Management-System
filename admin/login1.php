
<?php
session_start();
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
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        // $_SESSION['role'] = $user['role'];
        //echo 'chngaing';
        header("Location: admin_pannel.php");
            exit();
       
        }
 else {
        $error = "Invalid username/email or password";
        //header("Location: login.php");
            //exit();
    }
}
    


if (isset($_GET['action']) && $_GET['action'] == 'forgot') {
    // Code to handle forgot password, send reset link via email
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- CSS styles here -->
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="login.php">
        <label for="username_email">Email:</label>
        <input type="text" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="pass" name="pass" required><br>

        <input type="submit" value="Register">
    </form>
    <p style="color: red;"><?php echo $error; ?></p>
    <p><a href="?action=forgot">Forgot Password?</a></p>
</body>
</html>

