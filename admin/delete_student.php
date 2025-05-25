<?php session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
   header("Location: login.php");
   exit();
}
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_number = $_POST['roll_number'];

    // Check if the student exists
    $check_sql = "SELECT * FROM students WHERE roll_number = '$roll_number'";
    $check_result = pg_query($conn, $check_sql);

    if (pg_num_rows($check_result) > 0) {
        // Delete corresponding records from the meals table
        $delete_meals_sql = "DELETE FROM meals WHERE student_id IN (SELECT id FROM students WHERE roll_number = '$roll_number')";
        $delete_meals_result = pg_query($conn, $delete_meals_sql);

        if ($delete_meals_result) {
            // Now delete the student
            $delete_student_sql = "DELETE FROM students WHERE roll_number = '$roll_number'";
            $delete_student_result = pg_query($conn, $delete_student_sql);

            if ($delete_student_result) {
                echo '<script type="text/javascript"> Swal.fire("Student with roll number '.$roll_number.' deleted successfully."); setTimeout(function() { window.location.href = "delete_student.php" }, 1000);</script>';

                
            } else {
                echo '<script type="text/javascript"> Swal.fire("Error deleting student."); setTimeout(function() { window.location.href = "delete_student.php" }, 1000);</script>';
               
            }
        } else {
            echo "Error deleting meals records.";
        }
    } else {
        echo '<script type="text/javascript"> Swal.fire("Student with roll number '.$roll_number.' not found."); setTimeout(function() { window.location.href = "delete_student.php" }, 1000);</script>';
        
    }
}
?>


<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <!-- <base href="../"> -->
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="../images/favicon.png">
    <!-- Page Title  -->
    <title>Delete Student| Messwale</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="../assets/css/dashlite.css?ver=3.2.2">
    <link id="skin-default" rel="stylesheet" href="../assets/css/theme.css?ver=3.2.2">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <?php include 'admin_sidebar.php';?>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <?php include 'admin_header.php'; ?>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Delete Student</h3>
                                           
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                
                                            </div><!-- .toggle-wrap -->
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                               
                                            </div>
                                        </div>
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                
                                                <form method="POST" action="delete_student.php" class="gy-3">
                                                 
                                                    <div class="row g-3 align-center">
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                    <label class="form-label" for="full-name-1">Student roll Number</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"id="roll_number" name="roll_number" required>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        
                                               

                                                        <div class="row g-3">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mt-2">
                                                                    <button type="submit" class="btn btn-lg btn-primary">Delete Student</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>   
                                                </form>
                                            </div>
                                        </div><!-- card -->
                                    </div><!-- .nk-block -->

                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- select region modal -->
   
    <!-- JavaScript -->
    <script src="../assets/js/bundle.js?ver=3.2.2"></script>
    <script src="../assets/js/scripts.js?ver=3.2.2"></script>
    <script src="../assets/js/charts/gd-default.js?ver=3.2.2"></script>
</body>

</html>