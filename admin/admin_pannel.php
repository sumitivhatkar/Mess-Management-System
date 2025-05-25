<?php
    session_start();
    if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'admin') {
        header("Location: login.php");
        exit();
    }
    ?>

<html>
<h1 href="">attendance</h1>

    </html>