<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

// Fetch today's meals for the student
$currentDate = date('Y-m-d');
$stmt = $pdo->prepare("SELECT * FROM meals WHERE meal_date = :meal_date AND student_id = :student_id");
$stmt->execute(['meal_date' => $currentDate, 'student_id' => $_SESSION['user_id']]);
$meals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Panel - Meals Attendance</title>
    <!-- CSS styles here -->
</head>
<body>
    <h1>Meals Attendance</h1>
    <h2>Today's Date: <?php echo $currentDate; ?></h2>

    <form method="POST" action="record_attendance.php">
        <?php foreach ($meals as $meal): ?>
            <input type="checkbox" name="attendance[<?php echo $meal['meal_id']; ?>]" <?php echo $meal['attended'] ? 'checked' : ''; ?>>
            <?php echo $meal['meal_type']; ?><br>
        <?php endforeach; ?>
        <input type="submit" value="Submit Attendance">
    </form>
</body>
</html>
