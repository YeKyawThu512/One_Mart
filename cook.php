<?php
include("hash.php");
$days = 90;
echo $value = encryptCookie("+959692280652");
setcookie ("rememberme",$value,time()+ ($days *  24 * 60 * 60 ));
//echo "<script>window.open('index.php','_self')</script>";

?>