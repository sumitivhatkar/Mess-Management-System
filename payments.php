<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Payments</title>
</head>
<body>
    <h1>Student Payments</h1>
    <form action="process_payment.php" method="POST">
        <label for="student_id">Student ID:</label>
        <input type="number" id="student_id" name="student_id" required><br>
        <label for="payment_date">Payment Date:</label>
        <input type="date" id="payment_date" name="payment_date" required><br>
        <label for="amount_paid">Amount Paid:</label>
        <input type="number" id="amount_paid" name="amount_paid" step="0.01" min="0" required><br>
        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="Cash">Cash</option>
            <option value="Card">Card</option>
            <option value="Bank Transfer">Bank Transfer</option>
        </select><br>
        <input type="submit" value="Submit Payment">
    </form>
</body>
</html>

