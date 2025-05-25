<?php
session_start();
include '../config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
$conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");

// Handle form submission to update meal charges
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        echo "Meal charges updated successfully.";
    } else {
        echo "Error updating meal charges.";
    }
}

// Fetch current meal charges from the database
$fetch_sql = "SELECT meal_type, charge FROM meal_charges";
$fetch_result = pg_query($conn, $fetch_sql);
$meal_charges = pg_fetch_all($fetch_result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Meal Charges</title>
</head>
<body>
    <h1>Meal Charges</h1>

    <h2>Update Meal Charges</h2>
    <form method="POST" action="">
        <label for="breakfast_charge">Breakfast Charge:</label>
        <input type="text" id="breakfast_charge" name="breakfast_charge" value="<?php echo $meal_charges[0]['charge']; ?>"><br>
        <label for="lunch_charge">Lunch Charge:</label>
        <input type="text" id="lunch_charge" name="lunch_charge" value="<?php echo $meal_charges[1]['charge']; ?>"><br>
        <label for="dinner_charge">Dinner Charge:</label>
        <input type="text" id="dinner_charge" name="dinner_charge" value="<?php echo $meal_charges[2]['charge']; ?>"><br>
        <input type="submit" value="Update Charges">
    </form>

    <h2>Current Meal Charges</h2>
    <table border="1">
        <tr>
            <th>Meal Type</th>
            <th>Charge</th>
        </tr>
        <?php
        foreach ($meal_charges as $charge) {
            echo "<tr><td>{$charge['meal_type']}</td><td>{$charge['charge']}</td></tr>";
        }
        ?>
    </table>
</body>
</html>
