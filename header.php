<?php
// REAL HEADER file for hosting and WIT AWARD. 
error_reporting(0);
session_start();

include("dbcon.php");
include("hash.php"); 

if(empty($_COOKIE['rememberme']) OR $_COOKIE['rememberme'] == "" ) 
{
   echo "<script>window.open('home.php','_self')</script>";
} 

if(!empty($_COOKIE['rememberme']))
{
  
    $userphone  = decryptCookie($_COOKIE['rememberme']);
    
    $result     = $MySQLiconn->query("SELECT * FROM onemart_acc WHERE  phone = '".$userphone."' LIMIT 1");
    
    $res_count  = $result->num_rows;

    
    if($res_count == 1)
    {
        
        $row = $result->fetch_array();
        
        $id             = $row['id'];
        $name           = $row['username'];
        $shop_name      = $row['shop_name'];
        $address        = $row['address'];
        $category       = $row['category'];
        $phone          = $row['phone'];
        $backup1        = $row['backup1'];
        $backup2        = $row['backup2'];
        $viber          = $row['viber'];
        $messenger      = $row['messenger'];
        $facebook       = $row['facebook'];
        $profile        = $row['profile'];
        $shop_photo     = $row['shop_photo'];
        $created_date   = $row['created_date'];
        $modified_date  = $row['modified_date'];
        
        
        
        $like = $MySQLiconn->query("SELECT id FROM onemart_check WHERE  shop_id = '".$id."' AND status = '1' ");
        
        $lcount = $like->num_rows;
        
        
        $view = $MySQLiconn->query("SELECT id FROM onemart_view WHERE  shop_id = '".$id."' AND status = '1' ");
        
        $vcount = $view->num_rows;
        
        
        $save = $MySQLiconn->query("SELECT id FROM onemart_save WHERE  shop_id = '".$id."' AND status = '1' ");
        
        $scount = $save->num_rows;
        $vscount = $vcount + $scount;
        
        
        $comment = $MySQLiconn->query("SELECT id FROM onemart_comment WHERE  shop_id = '".$id."' AND status = '1' ");
        
        $ccount = $comment->num_rows;
        
        
        $order = $MySQLiconn->query("SELECT id FROM onemart_tempo WHERE  shop_id = '".$id."' AND cart = '0' AND pending = '1' ");
        
        $ocount = $order->num_rows;        
        
        
        //user active time
        date_default_timezone_set('Asia/Rangoon');  
        $today = date('Y-m-d h:i:s A');

        $MySQLiconn->query("UPDATE onemart_acc SET active = '$today' WHERE id='$id' and phone ='$phone' LIMIT 1");      

    }
    else
    {    
        echo "<script>window.open('home.php','_self')</script>";
    }

}

?>