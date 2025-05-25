<?php
// Include config.php for database connection
include 'config.php';
$conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");
session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
        header("Location: login.php");
        exit();
    }
// Retrieve form data
$student_id = $_POST['student_id'];
$payment_date = $_POST['payment_date'];
$amount_paid = $_POST['amount_paid'];
$payment_method = $_POST['payment_method'];

// Insert payment into payments table
$insert_payment_sql = "INSERT INTO payments (student_id, payment_date, amount_paid, payment_method) VALUES ($student_id, '$payment_date', $amount_paid, '$payment_method')";
$insert_payment_result = pg_query($conn, $insert_payment_sql);

if ($insert_payment_result) {
    
        // Set a success message in the session
        $_SESSION['upd_alert'] = 'Your Payment Processed!';

            // Redirect back to the main page
            header('Location: payment.php');
            exit; // Make sure to exit after the redirect
} else {
    $_SESSION['err_alert'] = 'something went wrong';

        // Redirect back to the main page
        header('Location: payment.php');
        exit; // Make sure to exit after the redirect
}
?>

