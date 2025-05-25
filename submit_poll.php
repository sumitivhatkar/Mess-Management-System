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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $breakfast = $_POST['breakfast'];
    $lunch = $_POST['lunch'];
    $dinner = $_POST['dinner'];
    $student_id = $_SESSION['user_id'];

    // Get the student ID from the session
    

    // Check if student ID is valid
    if (!empty($student_id)) {
        // Insert the meal choices into the database
        $insert_sql = "INSERT INTO meal_choices (student_id, date, breakfast, lunch, dinner) 
                       VALUES ('$student_id', '$date', '$breakfast', '$lunch', '$dinner')";
        $insert_result = pg_query($conn, $insert_sql);

        if ($insert_result) {
            echo "Meal choices submitted successfully.";
        } else {
            echo "Error submitting meal choices.";
        }
    } else {
        echo "Invalid student ID.";
    }
}
?>
