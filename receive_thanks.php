<?php
include("header.php");

if(empty($_GET['uid']))
{
    echo "<script>window.open('index.php','_self')</script>";
}

if(!empty($_GET['uid']))
{
    $uid = $_GET['uid'];

    $MySQLiconn->query("UPDATE onemart_tempo SET order_id = '0' WHERE user_id = '$uid' and cart = '0' and order_id = '1' and pending = '0' "); 

    $user = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$uid' order by created_date desc");
   
   $row=$user->fetch_array();
}
?>



<!doctype html>
<html lang="en">
  <head>
    <title>One Mart</title>
    <meta charset="utf-8">
    <meta name="description" content="One of the best Myanmar Online Marketplace.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="shortcut icon" href="logo/My Drawing (JPG).jpg">

    <!-- myanmar -->
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' />  
    <!-- myanmar -->

    <style type="text/css">

    body{
        height: 100%;
        background: #e6ffcc;
        color: #000;
    }
    .zawgyi{
        font-family:Zawgyi-One;
    }
    .unicode{
        font-family:Myanmar3,Yunghkio,'Masterpiece Uni Sans';
    }
    </style>
</head>
    <body>
 
        <div class="alert" role="alert" style="margin-top: 40px;">
            <h4 class="alert-heading" style="text-align: center;">Thank You!!!!</h4>
            <p class="zawgyi" style="text-align: center;margin-top: 30px;">
                OneMart မွ ဝယ္​ယူအား​ေပးျခင္​းအတြက္​ ​ေက်းဇူးအထူးတင္​ရိွပါတယ္​ <?php echo $row['username']; ?> ။
            </p><hr>
            <p class="zawgyi mb-0" style="text-align: center;">
                လူႀကီးမင္​း ရဲ႕ဝယ္​ယူမႈ​ေပၚမူတည္​ၿပီး​ေတာ့ OneMart ကပစၥည္​း​ေတြကို Discount ရႏိုင္​ပါတယ္​​ေနာ္​ ✌✌👌
            </p><hr>
            <p class="zawgyi mb-0" style="text-align: center;margin-bottom: 40px;">
                ဝယ္​ယူရတာ အခက္​အခဲ တစ္​စံုတစ္​ရာ ရိိွခဲ့လွ်င္​လည္​း ​ေဝဖန္​အၾကံျပဳႏိုင္​ပါတယ္​။ 💬 😘
            </p>
            <div>
                <a style="color: white;background-color: #02b875; text-decoration: none;" href="index.php" class="btn btn-block"> BACK </a>
            </div>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     
    </body>
</html>