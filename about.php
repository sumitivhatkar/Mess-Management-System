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
    <title>About | Messwale</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="assets/css/dashlite.css?ver=3.2.2">
    <link id="skin-default" rel="stylesheet" href="assets/css/theme.css?ver=3.2.2">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <?php include 'student_sidebar.php';?>
            <!-- sidebar @e -->
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
                                            <h3 class="nk-block-title page-title">About </h3>
                                           
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
                                            <div class="team">
                                                        
                                                        <div class="user-card user-card-s2">
                                                            <div class="user-avatar md bg-primary">
                                                                <span><?php echo $student_data['roll_number']; ?></span>
                                                                <div class="status dot dot-lg dot-success"></div>
                                                            </div>
                                                            <div class="user-info">
                                                                <h6><?php echo $student_data['full_name']; ?></h6>
                                                                <span class="sub-text"><?php echo $student_data['email']; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="team-details">
                                                            <p>Course:- <?php echo $student_data['course']; ?></p>
                                                        </div>

                                                        <div class="team-details">
                                                            <p>Address : <?php echo $student_data['address']; ?></p>
                                                        </div>
                                                       
                                                        <div class="team-view">
                                                            <a href="about.php" class="btn btn-round btn-outline-light w-150px"><span>View Profile</span></a>
                                                        </div>
                                                    </div><!-- .team -->
                                                
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
