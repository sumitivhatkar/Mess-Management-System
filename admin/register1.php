<!DOCTYPE html>
<html>
<head>
    <title>Admin Register</title>
    <!-- CSS styles here -->
</head>
<body>
    <h1>admin Registration</h1>
    <form method="POST" action="register.php">
        
    <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required><br>     
    
    <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

       

        <!-- <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="admin">Admin</option>
            <option value="student">Student</option>
        </select><br> -->

        <input type="submit" value="Register">
    </form>
</body>
</html>

<?php
include '../config.php';
include '../functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
   
    $role = 'admin';
    $full_name = sanitizeInput($_POST['full_name']);
    
    $sql = "INSERT INTO admins (full_name,email,pass,role) VALUES ('$full_name', '$email','$password','$role')";
        pg_query($sql);
        echo 'student data inserted';
    //}

    header("Location: login.php");
    exit();
}
?>
