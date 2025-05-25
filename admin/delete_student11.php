
<?php
session_start();
include '../config.php';
$conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");

// Check if admin is logged in
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_number = $_POST['roll_number'];

    // Check if the student exists
    $check_sql = "SELECT * FROM students WHERE roll_number = '$roll_number'";
    $check_result = pg_query($conn, $check_sql);

    if (pg_num_rows($check_result) > 0) {
        // Delete corresponding records from the meals table
        $delete_meals_sql = "DELETE FROM meals WHERE student_id IN (SELECT id FROM students WHERE roll_number = '$roll_number')";
        $delete_meals_result = pg_query($conn, $delete_meals_sql);

        if ($delete_meals_result) {
            // Now delete the student
            $delete_student_sql = "DELETE FROM students WHERE roll_number = '$roll_number'";
            $delete_student_result = pg_query($conn, $delete_student_sql);

            if ($delete_student_result) {
                echo "Student with roll number $roll_number deleted successfully.";
            } else {
                echo "Error deleting student.";
            }
        } else {
            echo "Error deleting meals records.";
        }
    } else {
        echo "Student with roll number $roll_number not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
</head>
<body>
    <h1>Delete Student</h1>
    <form method="POST" action="delete_student.php">
        <label for="roll_number">Enter Roll Number to Delete:</label>
        <input type="text" id="roll_number" name="roll_number" required><br>
        <input type="submit" value="Delete Student">
    </form>
</body>
</html>
