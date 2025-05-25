<?php
// Include config.php for database connection
include '../config.php';
$admin_id =$_SESSION['admin_id'];

// Check if admin_id ID is provided in the URL or as a parameter
if ($admin_id) {
 

    // Fetch admin_id data from the database
    $fetch_admin_sql = "SELECT * FROM admins WHERE id = $admin_id";
    $fetch_admin_result = pg_query($conn, $fetch_admin_sql);

    // Check if student data was fetched successfully
    if ($fetch_admin_result) {
        // Fetch student details as an associative array
        $admin_data = pg_fetch_assoc($fetch_admin_result);


    } else {
        echo "Error fetching student data.";
    }
} else {
    echo "Student ID not provided.";
}
?>

<div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="../images/messwale.png" srcset="../images/messwale.png 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="../images/messwale.png" srcset="../images/messwale.png 2x" alt="logo-dark">
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
                                    <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                            <div class="quick-icon border border-light">
                                                <img class="icon" src="./images/flags/english-sq.png" alt="">
                                            </div>
                                        </a>
                                     
                                    </li><!-- .dropdown -->
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                
                                                <div class="user-info d-none d-md-block">
                                                   
                                                    <div class="user-name dropdown-indicator">admin</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                       
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text"><?php echo $admin_data['full_name']; ?></span>
                                                        <span class="sub-text"><?php echo $admin_data['email']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    
                                                   
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="logout.php"><em class="icon ni ni-signout"></em><span>log out</span></a></li>
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