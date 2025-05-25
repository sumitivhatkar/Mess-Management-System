<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Meal Choices</title>
</head>
<body>
    <h1>Create Meal Choices</h1>
    <form method="POST" action="create_meal_choices.php">
        <label for="breakfast">Breakfast:</label>
        <input type="text" id="breakfast" name="breakfast"><br>

        <label for="lunch">Lunch:</label>
        <input type="text" id="lunch" name="lunch"><br>

        <label for="dinner">Dinner:</label>
        <input type="text" id="dinner" name="dinner"><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php
// Include config.php for database connection
include '../config.php';
$conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");

// Check if the user is logged in as an admin
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = date("Y-m-d"); // Get today's date
    $breakfast = $_POST['breakfast'];
    $lunch = $_POST['lunch'];
    $dinner = $_POST['dinner'];

    // Insert the meal choices into the database
    $insert_sql = "INSERT INTO meal_choices (date, breakfast, lunch, dinner) 
                   VALUES ('$date', '$breakfast', '$lunch', '$dinner')";
    $insert_result = pg_query($conn, $insert_sql);

    if ($insert_result) {
        echo "Meal choices created successfully for today.";
    } else {
        echo "Error creating meal choices.";
    }
}
?>
