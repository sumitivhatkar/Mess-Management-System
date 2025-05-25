<?php
    session_start();
    if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'admin') {
        header("Location: login.php");
        exit();
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Student Attendance</title>
    <!-- CSS styles here -->
</head>
<body>
    <h1>Admin Dashboard - Student Attendance</h1>

    <!-- Check if admin is logged in -->
    

    <h2>Update Attendance</h2>
    <form method="POST" action="update_attendance.php">
        <label for="id">Select Student:</label>
        <select id="id" name="id" required>
            <!-- Fetch and display student list from database -->
            <?php
            include '../config.php';
            $stmt = pg_query("SELECT id, full_name FROM students ORDER BY full_name");
            while ($row = pg_fetch_assoc($stmt)) {
                echo "<option value=\"{$row['id']}\">{$row['full_name']}</option>";
            }
            ?>
        </select><br>
        <label>Meal Type:</label><br>
        <input type="radio" id="breakfast" name="meal_type" value="Breakfast" required>
        <label for="breakfast">Breakfast</label><br>
        <input type="radio" id="lunch" name="meal_type" value="Lunch">
        <label for="lunch">Lunch</label><br>
        <input type="radio" id="dinner" name="meal_type" value="Dinner">
        <label for="dinner">Dinner</label><br>
        <label for="attended">Attended:</label>
        <input type="checkbox" id="attended" name="attended" value="1"><br>
        <input type="submit" value="Update Attendance">
    </form>

    <!-- Display attendance records for today -->
    <h2>Attendance Records Today</h2>
    <table border="1">
        <tr>
            <th>Student Name</th>
            <th>Breakfast</th>
            <th>Lunch</th>
            <th>Dinner</th>
        </tr>
        <!-- PHP code to
         fetch and display attendance records -->
        <?php

        $sql="SELECT s.full_name, m.breakfast, m.lunch, m.dinner FROM students s JOIN meals m ON s.id = m.student_id WHERE m.meal_date = CURRENT_DATE ORDER BY s.full_name";
        $stmt = pg_query($conn,$sql);
        // $stmt->execute();
        while ($row = pg_fetch_assoc($stmt)) {
            echo "<tr><td>{$row['full_name']}</td><td>{$row['breakfast']}</td><td>{$row['lunch']}</td><td>{$row['dinner']}</td></tr>";
        }
        ?>
    </table>
</body>
</html>
