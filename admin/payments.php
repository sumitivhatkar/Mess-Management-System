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
    <title>Payments| Messwale</title>
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
                                            <h3 class="nk-block-title page-title">Review Payments</h3>
                                           
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
                                                        <div class="nk-tb-col"><span class="sub-text">payment id</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Student id</span></div>
                                                       <div class="nk-tb-col tb-col-md"><span class="sub-text">payment date</span></div>
                                                        
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">amount paid</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">payment method</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">action</span></div>

                                                      
                                                        
                                                    </div><!-- .nk-tb-item -->
                                                         <?php
                                                        // Fetch pending payments for approval
                                                        $fetch_pending_payments_sql = "SELECT * FROM payments WHERE approved = FALSE";
                                                        $fetch_pending_payments_result = pg_query($conn, $fetch_pending_payments_sql);


                                                        if (pg_num_rows($fetch_pending_payments_result) > 0) {
                                                           
                                                            while ($row = pg_fetch_assoc($fetch_pending_payments_result)) {
                                                                
                                                            echo "<div class='nk-tb-item'>";
                                                            echo "<div class='nk-tb-col'><span>{$row['payment_id']}</span></div>";
                                                            echo "<div class='nk-tb-col'><span>{$row['student_id']}</span></div>";
                                                            echo "<div class='nk-tb-col'><span>{$row['payment_date']}</span></div>";
                                                            echo "<div class='nk-tb-col'><span>{$row['amount_paid']}</span></div>";
                                                            echo "<div class='nk-tb-col'><span>{$row['payment_method']}</span></div>";

                                                            echo "<div class='nk-tb-col'><a href='approve_payments.php?payment_id=" . $row['payment_id'] . "'>Approve</a></div>";
                                                            

                                                            echo "</div>";
                                                            // Calculate the majority choice for each meal type
                                                       
                                                        }
                                                    }
                                                        
                                                        
                                                            echo "</div>"; 
                                                   
                                                          
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