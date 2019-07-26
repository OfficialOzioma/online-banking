<?php
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
        header("location:admin_logout.php?sessionExpired=true");
        exit();
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>