<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <!-- CSS styles here -->
</head>
<body>
    <h1>User Registration</h1>
    <form method="POST" action="register.php">
        <!-- <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br> -->
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

       

        <label for="roll_number">Roll Number:</label>
        <input type="text" id="roll_number" name="roll_number" required><br>

        <label for="course">Course:</label>
        <input type="text" id="course" name="course" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br>

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
include 'config.php';
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST['username']);
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
        pg_query($sql);

       
        echo '<div class="example-alert">
        <div class="alert alert-fill alert-success alert-icon">
            <em class="icon ni ni-check-circle"></em> <strong>Registration success</strong>
             </div>
         </div>';
    //}

    header("Location: login.php");
    exit();
}
?>
