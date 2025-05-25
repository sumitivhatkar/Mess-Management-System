<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Meal Choices</title>
</head>
<body>
    <h1>View Meal Choices</h1>
    <table border="1">
        <tr>
            <th>Choice ID</th>
            <th>Date</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Breakfast Choice</th>
            <th>Lunch Choice</th>
            <th>Dinner Choice</th>
        </tr>
        <?php
        // Include config.php for database connection
        include '../config.php';
        $conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");

        // Check if the user is logged in as an admin
        
        if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: login.php");
            exit();
        }

        // Fetch meal choices and corresponding student details from the database
        $fetch_choices_sql = "SELECT mc.choice_id, mc.date, mc.student_id, mc.breakfast, mc.lunch, mc.dinner, s.full_name 
                              FROM meal_choices mc
                              JOIN students s ON mc.student_id = s.id";
        $fetch_choices_result = pg_query($conn, $fetch_choices_sql);

        while ($row = pg_fetch_assoc($fetch_choices_result)) {
            echo "<tr>";
            echo "<td>{$row['choice_id']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['student_id']}</td>";
            echo "<td>{$row['full_name']}</td>";
            echo "<td>{$row['breakfast']}</td>";
            echo "<td>{$row['lunch']}</td>";
            echo "<td>{$row['dinner']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
