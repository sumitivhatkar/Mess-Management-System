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
    <link rel="shortcut icon" href="images/favicon.png">
    <!-- Page Title  -->
    <title>Admin Dashboard | Messwale</title>
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
                <?php include 'admin_header.php';?>
                 <!-- content @s -->
                 <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Welcome to Dashboard : <?php echo $admin_data['full_name']; ?> </h3>
                                            
                                        </div>
                                        
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="row g-gs">
                                        <!-- .image-block-start -->
                                        
                                            <div class="col-sm-6 col-lg-4 col-xxl-3">
                                            <a href="create_meal.php">
                                                <div class=" gallery card card-bordered">
                                                    <img class="" src="../images/mealpoll.jpg" alt="">
                                                    <div>
                                                         <h2 centre> Create Meals </h2>
                                                        </div>
                                                    </div>
                                                    </a>
                                            </div>
                                      
                                        <!-- .image-block-end -->
                                        <!-- .image-block-start -->
                                        
                                        <div class="col-sm-6 col-lg-4 col-xxl-3">
                                            <a href="meal_charges.php">
                                                <div class="gallery card card-bordered">
                                                <img class="" src="../images/mealcharges.jpg" alt="">
                                                    <div>
                                                         <h2 centre> Meals Charges</h2>
                                                        </div>
                                                    </div>
                                                    </a>
                                            </div>
                                      
                                        <!-- .image-block-end -->
                                        <!-- .image-block-start -->
                                        
                                        <div class="col-sm-6 col-lg-4 col-xxl-3">
                                            <a href="attendance.php">
                                                <div class=" gallery card card-bordered">
                                                    <img class="" src="../images/attendance.jpg" alt="">
                                                    <div>
                                                         <h2 centre> Attendance</h2>
                                                        </div>
                                                    </div>
                                                    </a>
                                            </div>
                                             
                                        <div class="col-sm-6 col-lg-4 col-xxl-3">
                                            <a href="feedback.php">
                                                <div class=" gallery card card-bordered">
                                                    <img class="" src="../images/feedback.jpg" alt="">
                                                    <div>
                                                         <h2 centre> Student Feedback</h2>
                                                        </div>
                                                    </div>
                                                    </a>
                                            </div>
                                      
                                        <!-- .image-block-end -->
                                        <!-- .image-block-start -->
                                        
                                           
                                      
                                        <!-- .image-block-end -->
                                        <!-- .image-block-start -->
                                       
                                      
                                        <!-- .image-block-end -->


                                       
                                    </div>
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
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
