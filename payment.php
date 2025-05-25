<?php session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
   header("Location: login.php");
   exit();
}
include 'config.php';

// Get student ID from URL parameter
$student_id =$_SESSION['user_id'];

// Fetch meal charges from the database
$fetch_charges_sql = "SELECT * FROM meal_charges";
$fetch_charges_result = pg_query($conn, $fetch_charges_sql);




// Fetch attendance data for each meal type and calculate monthly charges
$total_monthly_payment = 0;
$days_in_month = date('t');
 

while ($charge_row = pg_fetch_assoc($fetch_charges_result)) {
    $meal_type = $charge_row['meal_type'];
    $charge_per_meal = $charge_row['charge'];

    
        // Convert monthly charge to daily charge
        $daily_charge = $charge_per_meal / $days_in_month;


    // Convert boolean values to integers (0 or 1) for summing
    $meal_type_int = ($meal_type == 'Breakfast') ? 'breakfast' : (($meal_type == 'Lunch') ? 'lunch' : 'dinner');

    // Fetch attendance data for the student and meal type
    $fetch_attendance_sql = "SELECT SUM(CAST($meal_type_int AS INT)) AS days_attended
                             FROM meals
                             WHERE student_id = $student_id
                            --  AND $meal_type = true
                             AND EXTRACT(MONTH FROM meal_date) = EXTRACT(MONTH FROM CURRENT_DATE)";
    $fetch_attendance_result = pg_query($conn, $fetch_attendance_sql);
    $attendance_data = pg_fetch_assoc($fetch_attendance_result);
    $days_attended = $attendance_data['days_attended'];

  

    // Calculate monthly charges for this meal type
    $monthly_charge = $daily_charge * $days_attended;
    $total_monthly_payment += $monthly_charge;
}
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
    <title>Payment | Messwale</title>
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
                                            <h3 class="nk-block-title page-title">Payment</h3>
                                           
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
                                                <!-- <div class="card-head">
                                                    <h5 class="card-title">Update Attendance</h5>
                                                </div> -->
                                                <form method="POST" action="process_payment.php" class="gy-3">
                                                    <div class="col-lg-4 col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-01">Student Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="default-01" value="<?php echo $student_data['full_name']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <input type="hidden" id="student_id" name="student_id" value="<?php echo $student_data['id']; ?>" required>
                                                    <input type="hidden" id="amount_paid" name="amount_paid" value="<?php echo $total_monthly_payment; ?>" required>
                                                        <div class="col-lg-4 col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Payment Date</label>
                                                            <div class="form-control-wrap">
                                                                <input type="date" class="form-control " id="payment_date" name="payment_date" required>
                                                            </div>
                                                            <div class="form-note">Date format <code>mm/dd/yyyy</code></div>
                                                        </div>
                                                    </div>
                                                

                                                        <div class="col-lg-4 col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-01">Amount</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" value="<?php echo $total_monthly_payment; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                 
                                                <div class="col-lg-4 col-sm-6">
                                                <label class="form-label" for="default-06">Payment Mode</label>

                                                    <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <select class="form-select js-select2" data-ui="xl" id="payment_method" name="payment_method" required>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="Card">Card</option>
                                                                        <option value="Bank Transfer">Netbanking</option>
                                                                    </select>
                                                                    
                                                                </div>
                                                            </div>
                                                    </div>
                                                   
                                                    
                                                    
                                                    <div class="row g-3">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mt-2">
                                                                <button type="submit" class="btn btn-lg btn-primary">Submit Payment</button>
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

if (isset($_SESSION['err_alert'])) {
    // Display the alert message using JavaScript

    echo '<script type="text/javascript"> Swal.fire("' . $_SESSION['err_alert'] . '");</script>';
   // echo '<script>alert("' . $_SESSION['alert'] . '");</script>';

    // Unset or clear the alert message from the session to prevent it from showing again on page refresh
    unset($_SESSION['err_alert']);
}
?>