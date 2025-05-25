<script src="../assets/js/example-sweetalert.js?ver=3.2.2"></script>
<?php
session_start();
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['id'];
    $meal_type = $_POST['meal_type'];
    $attended = isset($_POST['attended']) ? 'true' : 'false'; // Explicitly cast to boolean

    
    // Establish a connection to PostgreSQL
    //$conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");

    if (!$conn) {
        echo "Failed to connect to database.";
        exit();
    }

    // Check if the record already exists
    $check_sql = "SELECT id FROM meals WHERE student_id = $student_id AND meal_date = CURRENT_DATE";
    $check_result = pg_query($conn, $check_sql);

    if (pg_num_rows($check_result) > 0) {
        // If the record exists, update the existing record
        $update_sql = "UPDATE meals SET $meal_type = $attended WHERE student_id = $student_id AND meal_date = CURRENT_DATE";
        $update_result = pg_query($conn, $update_sql);
        
        // Set a success message in the session
        $_SESSION['upd_alert'] = 'Meals Record Updated successfully';

            // Redirect back to the main page
            header('Location: attendance.php');
            exit; // Make sure to exit after the redirect
        
        if (!$update_result) {
            echo "Error updating record.";
        }
    } else {
        // If the record does not exist, insert a new record
        $insert_sql = "INSERT INTO meals (student_id, meal_date, $meal_type) VALUES ($student_id, CURRENT_DATE, $attended)";
        $insert_result = pg_query($conn, $insert_sql);
        $_SESSION['upd_alert'] = 'Meals Record Updated successfully';

        // Redirect back to the main page
        header('Location: attendance.php');
        exit; // Make sure to exit after the redirect
        if (!$insert_result) {
            echo "Error inserting record.";
        }
    }

    pg_close($conn);

    // header("Location: attend.php");
    // exit();
}
?>
