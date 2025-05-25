<?php
// Include config.php for database connection
include 'config.php';
$conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");
session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
        header("Location: login.php");
        exit();
    }
// Assuming you have a session or parameter to identify the student ID
$student_id = $_SESSION['user_id'] ?? $_GET['user_id'];

// Fetch student information from the database
$fetch_student_sql = "SELECT * FROM students WHERE id = $student_id";
$fetch_student_result = pg_query($conn, $fetch_student_sql);
$student = pg_fetch_assoc($fetch_student_result);

// Fetch payment details for the current month from the payments table
$current_month = date('n');
$current_year = date('Y');
//$fetch_payment_sql = "SELECT * FROM payments WHERE student_id = $student_id AND payment_month = $current_month AND payment_year = $current_year AND approved = TRUE";

$fetch_payment_sql = "SELECT * FROM payments WHERE student_id = $student_id  AND approved = TRUE";

$fetch_payment_result = pg_query($conn, $fetch_payment_sql);

// Check if a payment for the current month is approved
if (pg_num_rows($fetch_payment_result) > 0) {
    // Fetch the payment details
    $payment_details = pg_fetch_assoc($fetch_payment_result);

    // Create HTML bill content
    $html_content = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Student Bill</title>
        <style>
            /* Add CSS styles for better presentation */
            body {
                font-family: Arial, sans-serif;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ccc;
            }
            h1 {
                text-align: center;
            }
            .bill-details {
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Student Bill</h1>
            <div class='bill-details'>
                <p><strong>Student Name:</strong> {$student['full_name']}</p>
                <p><strong>Email:</strong> {$student['email']}</p>
                <p><strong>Phone:</strong> {$student['course']}</p>
                <p><strong>Address:</strong> {$student['address']}</p>
                <p><strong>Month:</strong> " . date('F Y') . "</p>
                <p><strong>Amount Paid:</strong> $" . $payment_details['amount_paid'] . "</p>
                <p><strong>Payment Date:</strong> " . $payment_details['payment_date'] . "</p>
            </div>
        </div>
    </body>
    </html>
    ";

    // Output the HTML content
    echo $html_content;
} else {
    // No approved payment found for the current month
    echo "No payment details available for this month.";
}
?>
