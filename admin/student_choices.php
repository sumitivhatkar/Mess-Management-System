<?php session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
   header("Location: login.php");
   exit();
}
include '../config.php';
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
    <title>Student Meal Choices| Messwale</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="../assets/css/dashlite.css?ver=3.2.2">
    <link id="skin-default" rel="stylesheet" href="../assets/css/theme.css?ver=3.2.2">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <?php include 'admin_sidebar.php';?>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <?php include 'admin_header.php';?>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Student Meal Choices</h3>
                                           
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                
                                            </div><!-- .toggle-wrap -->
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                               
                                        
                                <div class="nk-block">
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner-group">
                                            
                                            <div class="card-inner p-0">
                                                <div class="nk-tb-list nk-tb-ulist is-compact">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col"><span class="sub-text">roll number</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Student name</span></div>
                                                       <div class="nk-tb-col tb-col-md"><span class="sub-text">Meal Type</span></div>
                                                        
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Meal Choice</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Date</span></div>
                                                      
                                                        
                                                    </div><!-- .nk-tb-item -->
                                                                                                    <?php
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

                                                            echo "<div class='nk-tb-item'>";
                                                            echo "<div class='nk-tb-col'><span>{$row['roll_number']}</span></div>";
                                                            echo "<div class='nk-tb-col'><span>{$row['full_name']}</span></div>";
                                                            echo "<div class='nk-tb-col'><span>{$row['meal_type']}</span></div>";
                                                            echo "<div class='nk-tb-col'><span>{$row['meal_choice']}</span></div>";
                                                            echo "<div class='nk-tb-col'><span>{$row['date']}</span></div>";
                                                            

                                                            echo "</div>";
                                                            // Calculate the majority choice for each meal type
                                                       
                                                        }
                                                        
                                                        $majority_choices = array();
                                                        foreach ($meal_counts as $meal_type => $choices) {
                                                            $counted_choices = array_count_values($choices);
                                                            arsort($counted_choices);
                                                            $majority_choice = key($counted_choices);
                                                            $majority_choices[$meal_type] = $majority_choice;
                                                        }
                                                            echo "</div>"; 
                                                   
                                                            // Display the majority choices for each meal type
                                                        echo "<h2>Majority Choices:</h2>";
                                                        echo "<ul>";
                                                        foreach ($majority_choices as $meal_type => $majority_choice) {
                                                            echo "<li>{$meal_type}: {$majority_choice}</li>";
                                                        }
                                                        echo "</ul>";
        ?>
                                            </div><!-- .card-inner -->
                                            
                                        </div><!-- .card-inner-group -->
                                    </div><!-- .card -->
                                    <div>
                                    
                                    </div>
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
    <script src="../assets/js/bundle.js?ver=3.2.2"></script>
    <script src="../assets/js/scripts.js?ver=3.2.2"></script>
    <script src="../assets/js/charts/gd-default.js?ver=3.2.2"></script>
</body>

</html>