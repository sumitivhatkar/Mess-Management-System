<?php session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
   header("Location: login.php");
   exit();
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
    <title>Admin Dashboard | Messwale</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="../assets/css/dashlite.css?ver=3.2.2">
    <link id="skin-default" rel="stylesheet" href="../assets/css/theme.css?ver=3.2.2">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <?php include 'admin_sidebar.php'; ?>
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
                                            <h3 class="nk-block-title page-title">Student List</h3>
                                           
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
                                            <div class="card-inner position-relative card-tools-toggle">
                                                
                                                
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0">
                                                <div class="nk-tb-list nk-tb-ulist is-compact">
                                                    <div class="nk-tb-item nk-tb-head">
                                                       
                                                        <div class="nk-tb-col"><span class="sub-text">Name</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Roll Number</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Course</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Address</span></div>
                                                        <div class="nk-tb-col"><span class="sub-text">Gender</span></div>
                                                        <div class="nk-tb-col"><span class="sub-text">Join Date</span></div>
                                                        
                                                    </div><!-- .nk-tb-item -->
                                                    <?php
        // Include config.php for database connection
        include '../config.php';
        $conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");

        // Check if admin is logged in
        //session_start();
        if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
             header("Location: login.php");
           // echo $_SESSION['admin_id'];
             exit();
        }

        // Fetch student details from the database
        $fetch_sql = "SELECT * FROM students";
        $fetch_result = pg_query($conn, $fetch_sql);

        while ($row = pg_fetch_assoc($fetch_result)) {
            echo "<div class='nk-tb-item'>";
            echo "<div class='nk-tb-col'><span>{$row['full_name']}</span></div>";
            echo "<div class='nk-tb-col'><span>{$row['roll_number']}</span></div>";
            echo "<div class='nk-tb-col'><span>{$row['course']}</span></div>";
            echo "<div class='nk-tb-col'><span>{$row['address']}</span></div>";
            echo "<div class='nk-tb-col'><span>{$row['gender']}</span></div>";
            echo "<div class='nk-tb-col'><span>{$row['created_at']}</span></div>";

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