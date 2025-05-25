<?php
// Include config.php for database connection
session_start();
include 'config.php';
//$conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");

      
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
        header("Location: login.php");
        exit();
    }

    $student_id = $_SESSION['user_id']; // Get student ID from session
    $date = date("Y-m-d"); // Get today's date

    // Check if any meal options were selected for breakfast
    if (isset($_POST['breakfast']) && is_array($_POST['breakfast'])) {
        foreach ($_POST['breakfast'] as $selected_breakfast) {
            // Insert each selected breakfast option into the database
            $insert_breakfast_sql = "INSERT INTO student_selections (student_id, date, meal_type, meal_choice) 
                                     VALUES ('$student_id', '$date', 'breakfast', '$selected_breakfast')";
            $insert_breakfast_result = pg_query($conn, $insert_breakfast_sql);
            // Handle the result as needed
        }
    }

    // Check if any meal options were selected for lunch
    if (isset($_POST['lunch']) && is_array($_POST['lunch'])) {
        foreach ($_POST['lunch'] as $selected_lunch) {
            // Insert each selected lunch option into the database
            $insert_lunch_sql = "INSERT INTO student_selections (student_id, date, meal_type, meal_choice) 
                                 VALUES ('$student_id', '$date', 'lunch', '$selected_lunch')";
            $insert_lunch_result = pg_query($conn, $insert_lunch_sql);
            // Handle the result as needed
        }
    }

    // Check if any meal options were selected for dinner
    if (isset($_POST['dinner']) && is_array($_POST['dinner'])) {
        foreach ($_POST['dinner'] as $selected_dinner) {
            // Insert each selected dinner option into the database
            $insert_dinner_sql = "INSERT INTO student_selections (student_id, date, meal_type, meal_choice) 
                                  VALUES ('$student_id', '$date', 'dinner', '$selected_dinner')";
            $insert_dinner_result = pg_query($conn, $insert_dinner_sql);
            // Handle the result as needed
        }
       
    }
      
        // Set a success message in the session
        $_SESSION['upd_alert'] = 'Your reqest submitted!';

            // Redirect back to the main page
            header('Location: choose_meal.php');
            exit; // Make sure to exit after the redirect
        
        
    // Redirect to a success page or back to the selection page
//     else {
//                 //$error = "Invalid username/email or password";
//                 echo '<script type="text/javascript"> Swal.fire("Invalid email or password");</script>';
//                 //header("Location: login.php");
//                     //exit();
// }
}else{
    $_SESSION['err_alert'] = 'something went wrong';

        // Redirect back to the main page
        header('Location: choose_meal.php');
        exit; // Make sure to exit after the redirect
}

?>
