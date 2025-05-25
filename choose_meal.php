<?php session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
   header("Location: login.php");
   exit();
}
include 'config.php';
?>


<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <!-- <base href="../"> -->
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="images/favicon.png">
    <!-- Page Title  -->
    <title>Choose meal  | Messwale</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="assets/css/dashlite.css?ver=3.2.2">
    <link id="skin-default" rel="stylesheet" href="assets/css/theme.css?ver=3.2.2">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <?php include 'student_sidebar.php';?>
            <!-- wrap @s -->
            <div class="nk-wrap ">
            <?php include 'student_header.php';?>
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Choose Meal</h3>
                                           
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
                                                
                                                <form method="POST" action="submit_meal_selection.php" class="gy-3">
                                                 
                                                    
                                                    
                                                    
                                                <div class="row g-3 align-center">
                                                        <?php
                                                                                                            
                                                                // Fetch all available meal choices from the database

                                                        $current_date = date("Y-m-d");
                                                        $fetch_choices_sql = "SELECT * FROM meal_choices WHERE date = '$current_date'";
                                                        //$fetch_choices_sql = "SELECT * FROM meal_choices";
                                                        $fetch_choices_result = pg_query($conn, $fetch_choices_sql);

                                                        if (pg_num_rows($fetch_choices_result) > 0) {
                                                            // Initialize arrays to store meal choices under each meal type
                                                            $breakfast_choices = [];
                                                            $lunch_choices = [];
                                                            $dinner_choices = [];
                                                        
                                                            while ($row = pg_fetch_assoc($fetch_choices_result)) {
                                                                // Split meal choices into arrays based on meal type
                                                                $breakfast_choices = array_merge($breakfast_choices, explode(", ", $row['breakfast']));
                                                                $lunch_choices = array_merge($lunch_choices, explode(", ", $row['lunch']));
                                                                $dinner_choices = array_merge($dinner_choices, explode(", ", $row['dinner']));

                                                                $date = $row['date'];
                                                            }
                                                            
                                                            // Remove duplicates and sort the arrays
                                                            $breakfast_choices = array_unique($breakfast_choices);
                                                            sort($breakfast_choices);

                                                            $lunch_choices = array_unique($lunch_choices);
                                                            sort($lunch_choices);

                                                            $dinner_choices = array_unique($dinner_choices);
                                                            sort($dinner_choices);
                                                            echo "<h2>Date: $date</h2>";


                                                         echo '<div class="col-lg-4">';
                                                         echo '<label class="form-label"> Breakfast</label>';
                                                            foreach ($breakfast_choices as $choice) {
                                                         echo ' <div class="preview-block">';
                                                         echo   '<div class="custom-control custom-checkbox">';
                                                        
                                                         echo      "<input type='checkbox' class='custom-control-input' id='breakfast_$choice' name='breakfast[]' value='$choice'>";
                                                        echo     "<label class='custom-control-label' for='breakfast_$choice'>$choice</label>";
                                                         echo  '</div>';
                                                        echo '</div>';
                                                         }
                                                        echo' </div>';
                                                     //kunch show
                                                        echo '<div class="col-lg-4">';
                                                        echo '<label class="form-label"> Lunch </label>';
                                                           foreach ($lunch_choices as $choice) {
                                                        echo ' <div class="preview-block">';
                                                        echo   '<div class="custom-control custom-checkbox">';
                                                       
                                                        echo      "<input type='checkbox' class='custom-control-input' id='lunch_$choice' name='lunch[]' value='$choice'>";
                                                       echo     "<label class='custom-control-label' for='lunch_$choice'>$choice</label>";
                                                        echo  '</div>';
                                                       echo '</div>';
                                                        }
                                                       echo' </div>';
                                                     //dinner show
                                                       echo '<div class="col-lg-4">';
                                                       echo '<label class="form-label"> Dinnner</label>';
                                                          foreach ($dinner_choices as $choice) {
                                                       echo ' <div class="preview-block">';
                                                       echo   '<div class="custom-control custom-checkbox">';
                                                      
                                                       echo      "<input type='checkbox' class='custom-control-input' id='dinner_$choice' name='dinner[]' value='$choice'>";
                                                      echo     "<label class='custom-control-label' for='dinner_$choice'>$choice</label>";
                                                       echo  '</div>';
                                                      echo '</div>';
                                                       }
                                                      echo' </div>';
                                                    } else {
                                                        echo "No meal choices available.";
                                                    }

                                                        ?>

                                                    </div>
                                                    
                                                    <div class="row g-3">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mt-2">
                                                                <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- card -->
                                    </div><!-- .nk-block -->
                               
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="assets/js/bundle.js?ver=3.2.2"></script>
    <script src="assets/js/scripts.js?ver=3.2.2"></script>
    <script src="assets/js/charts/gd-default.js?ver=3.2.2"></script>
</body>

</html>

<?php 
// Check if an alert message is set in the session
if (isset($_SESSION['upd_alert'])) {
    // Display the alert message using JavaScript

    echo '<script type="text/javascript"> Swal.fire("' . $_SESSION['upd_alert'] . '");</script>';
   // echo '<script>alert("' . $_SESSION['alert'] . '");</script>';

    // Unset or clear the alert message from the session to prevent it from showing again on page refresh
    unset($_SESSION['upd_alert']);
}
?>