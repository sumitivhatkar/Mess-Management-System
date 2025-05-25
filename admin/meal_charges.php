<?php session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
   header("Location: login.php");
   exit();
}
include '../config.php';




// Fetch current meal charges from the database
$fetch_sql = "SELECT meal_type, charge FROM meal_charges";
$fetch_result = pg_query($conn, $fetch_sql);
$meal_charges = pg_fetch_all($fetch_result);
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
    <title>Meal Charges| Messwale</title>
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
                                            <h3 class="nk-block-title page-title">Meal Charges</h3>
                                           
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
                                                
                                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="gy-3">
                                                 
                                                    <div class="row g-3 align-center">
                                                        
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                    <label class="form-label" for="full-name-1">Breakfast Charges</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="breakfast_charge" name="breakfast_charge" value="<?php echo $meal_charges[0]['charge']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                    <label class="form-label" for="full-name-1">Lunch Charges</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="lunch_charge" name="lunch_charge" value="<?php echo $meal_charges[1]['charge']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                    <label class="form-label" for="full-name-1">Dinner Charges</label>
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control" id="dinner_charge" name="dinner_charge" value="<?php echo $meal_charges[2]['charge']; ?>">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        
                                               

                                                        <div class="row g-3">
                                                            <div class="col-lg-6">
                                                                <div class="form-group mt-2">
                                                                    <button type="submit" class="btn btn-lg btn-primary" name="submit" value="Submit">Create</button>
                                                                </div>
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
                                                        <h5 class="card-title"> Meal charges</h5>
                                                </div>
                                            </div><!-- .card-inner -->
                                            <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Meal type</th>
                                                            <th scope="col">Meal Charges</th>
                                                           
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                            foreach ($meal_charges as $charge) {
                                                                echo "<tr><td>{$charge['meal_type']}</td><td>{$charge['charge']}</td></tr>";
                                                            }
                                                            ?>
                                                       
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- .card-preview -->
                                            
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
    <!-- <script src="../assets/js/example-sweetalert.js?ver=3.2.2"></script> -->

    <script src="../assets/js/charts/gd-default.js?ver=3.2.2"></script>
</body>

</html>

<?php
// Handle form submission to update meal charges
if (isset($_POST['submit'])) {
    $breakfast_charge = $_POST['breakfast_charge'];
    $lunch_charge = $_POST['lunch_charge'];
    $dinner_charge = $_POST['dinner_charge'];

    // Update meal charges in the database
    $update_sql = "UPDATE meal_charges SET charge = CASE meal_type
                    WHEN 'Breakfast' THEN $breakfast_charge
                    WHEN 'Lunch' THEN $lunch_charge
                    WHEN 'Dinner' THEN $dinner_charge
                    END";
    $update_result = pg_query($conn, $update_sql);

    if ($update_result) {
        echo '<script type="text/javascript"> Swal.fire("Meal charges updated successfully"); setTimeout(function() { window.location.href = "meal_charges.php" }, 1000);</script>';
        
    } else {
        echo '<script type="text/javascript"> Swal.fire("Error updating meal charges.");</script>';
        
    }
}
?>