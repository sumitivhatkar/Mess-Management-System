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
    <title>Create Meals| Messwale</title>
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
                                            <h3 class="nk-block-title page-title">Create Meal </h3>
                                           
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
                                                
                                                <form method="POST" action="update_attendance.php" class="gy-3">
                                                 
                                                    <div class="row g-3 align-center">
                                                        
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                    <label class="form-label" for="full-name-1">Breakfast</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="full-name-1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                    <label class="form-label" for="full-name-1">Lunch</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="full-name-1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                    <label class="form-label" for="full-name-1">Dinner</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="full-name-1">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        
                                               

                                                        <div class="row g-3">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mt-2">
                                                                    <button type="submit" class="btn btn-lg btn-primary">Create</button>
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