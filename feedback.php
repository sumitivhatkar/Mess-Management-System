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
    <title>Feedback | Messwale</title>
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
                                        <!-- .nk-block-head-content -->
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
                                            <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Feedback</h3>
                                           
                                        </div>
                                                
                                                <form method="POST" action="feedback.php" class="gy-3">
                                                 
                                                    
                                                    
                                                    
                                                <div class="row g-3 align-center">
                                                           <div class="form-group">
                                                                   
                                                                    <div class="form-control-wrap">
                                                                    <textarea class="form-control " id="feedback" name="feedback" rows="4" cols="50" required></textarea><br><br>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                                <div class="row g-3">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mt-2">
                                                                <button type="submit" class="btn btn-lg btn-primary">Submit Feedback</button>
                                                            </div>
                                                        </div>
                                                    </div>
<!--                                                     
                                                    <div class="row g-3 align-center">
                                                        
                                                    </div> -->
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
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get student ID from session or wherever you're storing it
    $student_id = $_SESSION['user_id']; // Assuming you have a session for student ID

    // Get feedback text from form
    $feedback_text = $_POST['feedback'];

    // Insert feedback into database
    $insert_feedback_sql = "INSERT INTO feedback (student_id, feedback_text) VALUES ($student_id, '$feedback_text')";
    $insert_feedback_result = pg_query($conn, $insert_feedback_sql);

    if ($insert_feedback_result) {
        echo '<script type="text/javascript"> Swal.fire("Feedback submitted successfully!"); setTimeout(function() { window.location.href = "feedback.php" }, 1000);</script>';
       
       
    } else {
        echo '<script type="text/javascript"> Swal.fire("Error submitting feedback."); setTimeout(function() { window.location.href = "feedback.php" }, 1000);</script>';
       
    }
} else {
    echo "Invalid request.";
}
?>