<?php
    include "connect.php";

    session_start();
    session_destroy();

    if (isset($_GET['sessionExpired'])) {
        header("location:admin_session_expired.php");
    }
    else {
        header("location:admin_login.php");        
    }
?>