<?php
error_reporting(0);
session_start();

include_once 'dbcon.php';
include "hash.php";

if(isset($_POST['insert']))
{   
    
    date_default_timezone_set('Asia/Rangoon');  
    $today = date('idshym');

    $name  = test_input(mysqli_real_escape_string($MySQLiconn, $_POST['val-name']));
    $phone = test_input(mysqli_real_escape_string($MySQLiconn, $_POST['val-phone']));
        
    $imgFile = $_FILES['val-img']['name'];
    $tmp_dir = $_FILES['val-img']['tmp_name'];
    $imgSize = $_FILES['val-img']['size'];

    if($imgFile)
    {
        $upload_dir = 'profile/'; // upload directory    
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
        $userpic = 'OneMartProfile_'.$today.rand(1000,1000000).".".$imgExt;
        
        if(in_array($imgExt, $valid_extensions))
        {           
            if($imgSize < 5000000)
            {
                move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            }
            else
            {
                $errMSG = "Sorry, your file is too large it should be less then 5MB";
            }
        }
        else
        {
            $errMSG = "Sorry, only JPG, JPEG & PNG files are allowed.";        
        }   
    }

    if(!isset($errMSG))
    {

        $MySQLiconn->query("INSERT INTO onemart_acc(username, phone, profile, created_date, modified_date) VALUES('".$name."', '".$phone."',  '".$userpic."', now(), now())");        
        $days = 90;
        $value = encryptCookie($phone);
        setcookie ("rememberme",$value,time()+ ($days *  24 * 60 * 60 ));
        
?>
        <script>
            alert('Your Account is successfully Activated. Thanks for using OneMart! ...');
            window.location.href='index.php';    
        </script>

<?php
    }

}

    function test_input($inputField)
    {  
        $inputField = htmlspecialchars(stripcslashes(strip_tags($inputField)));
        return $inputField;  
    }

?>