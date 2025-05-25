<?php session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
   header("Location: login.php");
   exit();
}
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Student Payment</title>
</head>
<body>
    <h1>Calculate Student Payment</h1>
    <form action="calculate_payment.php" method="GET">
        <label for="student_id">Enter Student ID:</label>
        <input type="text" id="student_id" name="student_id" required>
        <button type="submit">Calculate Payment</button>
    </form>
</body>
</html>
<?php
// Include config.php for database connection
//include 'config.php';

// Check if student ID is provided in the URL
if (isset($_GET['student_id'])) {

// Get student ID from URL parameter
$student_id = $_GET['student_id'];

// Fetch meal charges from the database
$fetch_charges_sql = "SELECT * FROM meal_charges";
$fetch_charges_result = pg_query($conn, $fetch_charges_sql);




// Fetch attendance data for each meal type and calculate monthly charges
$total_monthly_payment = 0;
$days_in_month = date('t');
 

while ($charge_row = pg_fetch_assoc($fetch_charges_result)) {
    $meal_type = $charge_row['meal_type'];
    $charge_per_meal = $charge_row['charge'];

    
        // Convert monthly charge to daily charge
        $daily_charge = $charge_per_meal / $days_in_month;


    // Convert boolean values to integers (0 or 1) for summing
    $meal_type_int = ($meal_type == 'Breakfast') ? 'breakfast' : (($meal_type == 'Lunch') ? 'lunch' : 'dinner');

    // Fetch attendance data for the student and meal type
    $fetch_attendance_sql = "SELECT SUM(CAST($meal_type_int AS INT)) AS days_attended
                             FROM meals
                             WHERE student_id = $student_id
                            --  AND $meal_type = true
                             AND EXTRACT(MONTH FROM meal_date) = EXTRACT(MONTH FROM CURRENT_DATE)";
    $fetch_attendance_result = pg_query($conn, $fetch_attendance_sql);
    $attendance_data = pg_fetch_assoc($fetch_attendance_result);
    $days_attended = $attendance_data['days_attended'];

  

    // Calculate monthly charges for this meal type
    $monthly_charge = $daily_charge * $days_attended;
    $total_monthly_payment += $monthly_charge;
}
echo 'days attend is ' .$days_attended ;
echo "Total Monthly Payment for Student ID $student_id: $" . $total_monthly_payment;
} else {
    echo "Student ID not provided.";
}
?>
