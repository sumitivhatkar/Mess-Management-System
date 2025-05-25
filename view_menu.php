


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Poll System</title>
</head>
<body>
    <h1>Meal Poll System</h1>
    <form method="POST" action="submit_poll.php">
        <table>
            <tr>
                <th>Date</th>
                <th>Student</th>
                <th>Breakfast Choice</th>
                <th>Lunch Choice</th>
                <th>Dinner Choice</th>
            </tr>
            <?php
            // Include config.php for database connection
            include 'config.php';
            $conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");

            // Check if the user is logged in as a student
            session_start();
            if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
                header("Location: login.php");
                exit();
            }

            // Fetch student details from the database
            $fetch_students_sql = "SELECT id, full_name FROM students WHERE id = {$_SESSION['user_id']}";
            $fetch_students_result = pg_query($conn, $fetch_students_sql);

            if ($row = pg_fetch_assoc($fetch_students_result)) {
                echo "<tr>";
                echo "<td><input type='date' name='date'></td>";
                echo "<td>{$row['full_name']}</td>";
                echo "<td><input type='text' name='breakfast'></td>";
                echo "<td><input type='text' name='lunch'></td>";
                echo "<td><input type='text' name='dinner'></td>";
                echo "<input type='hidden' name='student_id' value='{$_SESSION['user_id']}'>";
                echo "</tr>";
            }
            ?>
        </table>
        <input type="submit" value="Submit Choices">
    </form>
</body>
</html>
