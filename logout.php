<?php
	session_start();
    session_destroy();
    $days = 90;
    setcookie ("rememberme","", time() - ($days *  24 * 60 * 60 ) );
    echo "<script>window.open('home.php','_self')</script>";
?>