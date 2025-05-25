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
// Fetch pending payments for approval
$fetch_pending_payments_sql = "SELECT * FROM payments WHERE approved = FALSE";
$fetch_pending_payments_result = pg_query($conn, $fetch_pending_payments_sql);

if (pg_num_rows($fetch_pending_payments_result) > 0) {
    echo "<h1>Pending Payments</h1>";
    echo "<table>";
    echo "<tr><th>Payment ID</th><th>Student ID</th><th>Payment Date</th><th>Amount Paid</th><th>Payment Method</th><th>Action</th></tr>";
    while ($row = pg_fetch_assoc($fetch_pending_payments_result)) {
        echo "<tr>";
        echo "<td>" . $row['payment_id'] . "</td>";
        echo "<td>" . $row['student_id'] . "</td>";
        echo "<td>" . $row['payment_date'] . "</td>";
        echo "<td>" . $row['amount_paid'] . "</td>";
        echo "<td>" . $row['payment_method'] . "</td>";
        echo "<td><a href='approve_payments.php?payment_id=" . $row['payment_id'] . "'>Approve</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No pending payments.";
}
?>
