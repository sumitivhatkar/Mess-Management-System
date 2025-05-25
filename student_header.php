<?php
// Include config.php for database connection
include 'config.php';
$student_id =$_SESSION['user_id'];

// Check if student ID is provided in the URL or as a parameter
if ($student_id) {
    // Get student ID from URL parameter
    //$student_id = $_GET['student_id'];

    // Fetch student data from the database
    $fetch_student_sql = "SELECT * FROM students WHERE id = $student_id";
    $fetch_student_result = pg_query($conn, $fetch_student_sql);

    // Check if student data was fetched successfully
    if ($fetch_student_result) {
        // Fetch student details as an associative array
        $student_data = pg_fetch_assoc($fetch_student_result);

        // Display student details
        // echo "<h1>Student Details</h1>";
        // echo "<p>ID: " . $student_data['id'] . "</p>";
        // echo "<p>Name: " . $student_data['full_name'] . "</p>";
        // echo "<p>Address: " . $student_data['address'] . "</p>";
        // echo "<p>Gender: " . $student_data['gender'] . "</p>";
        // echo "<p>Course: " . $student_data['course'] . "</p>";

        // You can display more student details as needed

    } else {
        echo "Error fetching student data.";
    }
} else {
    echo "Student ID not provided.";
}
?>


<!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="./images/messwale.png" srcset="./images/messwale 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="./images/messwale.png" srcset="./images/messwale 2x" alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-news d-none d-xl-block">
                                <div class="nk-news-list">
                                    <a class="nk-news-item" href="#">
                                        <div class="nk-news-icon">
                                            <em class="icon ni ni-card-view"></em>
                                        </div>
                                        
                                    </a>
                                </div>
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                   
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                   
                                                    <div class="user-name dropdown-indicator"> <?php echo $student_data['full_name']; ?></div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span> <?php echo $student_data['roll_number']; ?></span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text"> <?php echo $student_data['full_name']; ?></span>
                                                        <span class="sub-text"><?php echo $student_data['email']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="about.php"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                   
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="logout.php"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                   <!-- .dropdown -->
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->