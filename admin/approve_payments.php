<?php
// Include config.php for database connection
include '../config.php';
$conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");

        // Check if admin is logged in
        session_start();
        if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: login.php");
            exit();
        }
// Retrieve payment ID from the URL parameter
$payment_id = $_GET['payment_id'];

// Update payment status to approved
$update_payment_sql = "UPDATE payments SET approved = TRUE WHERE payment_id = $payment_id";
$update_payment_result = pg_query($conn, $update_payment_sql);

if ($update_payment_result) {
    echo "Payment approved successfully.";
} else {
    echo "Error approving payment.";
}
?>
