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
    <title>Admin Dashboard | Messwale</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="../assets/css/dashlite.css?ver=3.2.2">
    <link id="skin-default" rel="stylesheet" href="../assets/css/theme.css?ver=3.2.2">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <?php include 'admin_sidebar.php'; ?>
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
                                            <h3 class="nk-block-title page-title">Attendance Mangement</h3>
                                           
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
                                                <div class="card-head">
                                                    <h5 class="card-title">Update Attendance</h5>
                                                </div>
                                                <form method="POST" action="update_attendance.php" class="gy-3">
                                                 
                                                    <div class="row g-3 align-center">
                                                        
                                                        <div class="col-lg-7">
                                                            <label class="form-label">Select Student</label>
                                                            <div class="form-control-wrap">
                                                                <select class="form-select js-select2" data-search="on" id="id" name="id" required>
                                                                   <?php
                                                                        $stmt = pg_query("SELECT id, full_name FROM students ORDER BY full_name");
                                                                            while ($row = pg_fetch_assoc($stmt)) {
                                                                                echo "<option value=\"{$row['id']}\">{$row['full_name']}</option>";
                                                                            }
                                                                    ?>
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row g-3 align-center">
                                                        <!-- <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Allow Registration</label>
                                                                <span class="form-note">Enable or disable registration from site.</span>
                                                            </div>
                                                        </div> -->
                                                        <label class="form-label">meal type:</label>
                                                        <div class="col-lg-6">
                                                            <ul class="custom-control-group g-3 align-center flex-wrap">
                                                                <li>
                                                                    <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                                                        <input type="radio"  class="custom-control-input"  id="breakfast" name="meal_type" value="Breakfast">
                                                                        <label  class="custom-control-label" for="breakfast">breakfast</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                                                        <input type="radio" class="custom-control-input" id="lunch" name="meal_type" value="Lunch">
                                                                        <label  class="custom-control-label" for="lunch">lunch</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                                                        <input type="radio" class="custom-control-input" id="dinner" name="meal_type" value="Dinner">
                                                                        <label  class="custom-control-label" for="dinner">dinner</label>
                                                                    </div>
                                                                </li>

                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row g-3 align-center">
                                                        <!-- <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Allow Registration</label>
                                                                <span class="form-note">Enable or disable registration from site.</span>
                                                            </div>
                                                        </div> -->
                                                        <label class="form-label">Attended :</label>
                                                        <div class="col-lg-6">
                                                            <ul class="custom-control-group g-3 align-center flex-wrap">
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input  class="custom-control-input" type="checkbox" id="attended" name="attended" value="1" required>
                                                                        <label class="custom-control-label" for="attended">Enable</label>
                                                                    </div>
                                                                </li>
                                                                
                                                            </ul>
                                                        </div>
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
                                <div class="nk-block">
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner-group">
                                            <div class="card-inner position-relative card-tools-toggle">
                                                
                                            <div class="card-head">
                                                    <h5 class="card-title"> Attendance List</h5>
                                                </div>
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0">
                                                <div class="nk-tb-list nk-tb-ulist is-compact">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col"><span class="sub-text">Student Name</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Breakfast</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Lunch</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Dinner</span></div>
                                                      
                                                        
                                                    </div><!-- .nk-tb-item -->
                                                    <?php
        $sql="SELECT s.full_name, m.breakfast, m.lunch, m.dinner FROM students s JOIN meals m ON s.id = m.student_id WHERE m.meal_date = CURRENT_DATE ORDER BY s.full_name";
        $stmt = pg_query($conn,$sql);

        while ($row = pg_fetch_assoc($stmt)) {
            echo "<div class='nk-tb-item'>";
            echo "<div class='nk-tb-col'><span>{$row['full_name']}</span></div>";
            if($row['breakfast']==='t'){
                echo "<div class='nk-tb-col'><span><em class='icon text-success ni ni-check-circle'></em></span></div>";
            }else{
                echo "<div class='nk-tb-col'><span><em class='icon text-danger ni ni-check-circle'></em></span></div>";
            }
            if($row['lunch']==='t'){
                echo "<div class='nk-tb-col'><span><em class='icon text-success ni ni-check-circle'></em></span></div>";
            }else{
                echo "<div class='nk-tb-col'><span><em class='icon text-danger ni ni-check-circle'></em></span></div>";
            }
            if($row['dinner']==='t'){
                echo "<div class='nk-tb-col'><span><em class='icon text-success ni ni-check-circle'></em></span></div>";
            }else{
                echo "<div class='nk-tb-col'><span><em class='icon text-danger ni ni-check-circle'></em></span></div>";
            }
            // echo "<div class='nk-tb-col'><span>{$row['breakfast']}</span></div>";
            // echo "<div class='nk-tb-col'><span>{$row['lunch']}</span></div>";
            // echo "<div class='nk-tb-col'><span>{$row['dinner']}</span></div>";
            

            echo "</div>";
        }
        ?>
                                                    
                                                </div><!-- .nk-tb-list -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner">
                                                <ul class="pagination justify-content-center justify-content-md-start">
                                                    <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                                                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                </ul><!-- .pagination -->
                                            </div><!-- .card-inner -->
                                        </div><!-- .card-inner-group -->
                                    </div><!-- .card -->
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