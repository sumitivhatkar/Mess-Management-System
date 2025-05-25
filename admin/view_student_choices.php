<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Meal Choices</title>
</head>
<body>
    <h1>View Student Meal Choices</h1>
    <table border="1">
        <tr>
            <th>roll number</th>
            <th>Student name</th>
            <th>Date</th>
            <th>Meal Type</th>
            <th>Meal Choice</th>
        </tr>
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
        $current_date = date("Y-m-d");
        // Fetch student meal choices from the database
        $fetch_choices_sql = "SELECT s.id,s.full_name,s.roll_number ,ss.date, ss.meal_type, ss.meal_choice 
                              FROM student_selections ss
                              JOIN students s ON ss.student_id = s.id WHERE ss.date = '$current_date'";
        $fetch_choices_result = pg_query($conn, $fetch_choices_sql);

        // Count the number of students selecting each meal choice for each meal type
        $meal_counts = array('breakfast' => array(), 'lunch' => array(), 'dinner' => array());
        while ($row = pg_fetch_assoc($fetch_choices_result)) {
            $meal_counts[$row['meal_type']][] = $row['meal_choice'];
            echo "<tr>";
            echo "<td>{$row['roll_number']}</td>";
            echo "<td>{$row['full_name']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['meal_type']}</td>";
            echo "<td>{$row['meal_choice']}</td>";
            echo "</tr>";
        }

        // Calculate the majority choice for each meal type
        $majority_choices = array();
        foreach ($meal_counts as $meal_type => $choices) {
            $counted_choices = array_count_values($choices);
            arsort($counted_choices);
            $majority_choice = key($counted_choices);
            $majority_choices[$meal_type] = $majority_choice;
        }

        echo "</table>";

        // Display the majority choices for each meal type
        echo "<h2>Majority Choices:</h2>";
        echo "<ul>";
        foreach ($majority_choices as $meal_type => $majority_choice) {
            echo "<li>{$meal_type}: {$majority_choice}</li>";
        }
        echo "</ul>";
        ?>
</body>
</html>
