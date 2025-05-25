<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Meal</title>
</head>
<body>
    <h1>Choose Meal</h1>
    <form method="POST" action="submit_meal_selection.php">
        <?php
        // Include config.php for database connection
        include 'config.php';
        $conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");

        // Fetch all available meal choices from the database

        $current_date = date("Y-m-d");
        $fetch_choices_sql = "SELECT * FROM meal_choices WHERE date = '$current_date'";
        //$fetch_choices_sql = "SELECT * FROM meal_choices";
        $fetch_choices_result = pg_query($conn, $fetch_choices_sql);

        if (pg_num_rows($fetch_choices_result) > 0) {
            // Initialize arrays to store meal choices under each meal type
            $breakfast_choices = [];
            $lunch_choices = [];
            $dinner_choices = [];
           
            while ($row = pg_fetch_assoc($fetch_choices_result)) {
                // Split meal choices into arrays based on meal type
                $breakfast_choices = array_merge($breakfast_choices, explode(", ", $row['breakfast']));
                $lunch_choices = array_merge($lunch_choices, explode(", ", $row['lunch']));
                $dinner_choices = array_merge($dinner_choices, explode(", ", $row['dinner']));

                $date = $row['date'];
            }
            
            // Remove duplicates and sort the arrays
            $breakfast_choices = array_unique($breakfast_choices);
            sort($breakfast_choices);

            $lunch_choices = array_unique($lunch_choices);
            sort($lunch_choices);

            $dinner_choices = array_unique($dinner_choices);
            sort($dinner_choices);
            echo "<h2>Date: $date</h2>";
            echo "<h2>Breakfast:</h2>";
            echo "<div>";
            foreach ($breakfast_choices as $choice) {
                echo "<input type='checkbox' id='breakfast_$choice' name='breakfast[]' value='$choice'>";
                echo "<label for='breakfast_$choice'>$choice</label><br>";
            }
            echo "</div>";

            echo "<h2>Lunch:</h2>";
            echo "<div>";
            foreach ($lunch_choices as $choice) {
                echo "<input type='checkbox' id='lunch_$choice' name='lunch[]' value='$choice'>";
                echo "<label for='lunch_$choice'>$choice</label><br>";
            }
            echo "</div>";

            echo "<h2>Dinner:</h2>";
            echo "<div>";
            foreach ($dinner_choices as $choice) {
                echo "<input type='checkbox' id='dinner_$choice' name='dinner[]' value='$choice'>";
                echo "<label for='dinner_$choice'>$choice</label><br>";
            }
            echo "</div>";
        } else {
            echo "No meal choices available.";
        }
        ?>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
