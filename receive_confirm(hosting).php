<?php
// facebook account kit integration for receive order
error_reporting(0);
session_start();

include("header.php");

// Initialize variables
$app_id = '329534654476016';
$secret = 'f2e62f9a2f0fcaf8d97dd937b2c73e43';
$version = 'v1.1'; // 'v1.1' for example

// Method to send Get request to url
function doCurl($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $data = json_decode(curl_exec($ch), true);
  curl_close($ch);
  return $data;
}

// Exchange authorization code for access token
$token_exchange_url = 'https://graph.accountkit.com/'.$version.'/access_token?'.
  'grant_type=authorization_code'.
  '&code='.$_POST['code'].
  "&access_token=AA|$app_id|$secret";
$data = doCurl($token_exchange_url);
$user_id = $data['id'];
$user_access_token = $data['access_token'];
$refresh_interval = $data['token_refresh_interval_sec'];

// Get Account Kit information
$me_endpoint_url = 'https://graph.accountkit.com/'.$version.'/me?'.
  'access_token='.$user_access_token;
$data = doCurl($me_endpoint_url);
$phone = isset($data['phone']) ? $data['phone']['number'] : '';
$email = isset($data['email']) ? $data['email']['address'] : '';


if(empty($phone))
{
  echo "<script>window.open('receive_form.php','_self')</script>";
}

$result = $MySQLiconn->query("SELECT * FROM onemart_tempo WHERE user_phone = '".$phone."' and cart = '0' and order_id = '1' and pending = '0' order by created_date desc ");

$count = $result->num_rows;
     
?> 


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="One of the best Myanmar Online Marketplace.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>One Mart</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="logo/My Drawing (JPG).jpg">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
     
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/w3.css" rel="stylesheet">

    <!-- myanmar -->
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' />  
    <!-- myanmar -->

    <style>

        body{
            background: white;
            color: #02b875;
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

        <?php if($count > 0){ ?>

        <p class="zawgyi" style="color: #02b875;text-align: center;margin-top: 20px;font-size: 17px; font-weight: bold;"> 
             လူႀကီးမင္​း မွာယူထားသည္​့ ပစၥည္​းမ်ားကို ​ေသခ်ာစြာ
             စစ္​​ေဆးၿပီးမွ လက္​ခံ​ေပးပါ​ေနာ္​။ 😍
        </p>
      
        <!-- Container fluid  -->
        <div class="container-fluid">
            <div class="card-body" style="margin-top: 30px;margin-bottom: 30px;">
                <div class="recent-meaasge">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Shop Name </th>
                                <th scope="col">Shop Phone</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                       <?php
                        $no     = 0;
                        $total  = 0;
                        while($col=$result->fetch_array()) 
                        { 

                            $qty     = $col['qty'];
                            $post_id = $col['post_id'];
                            $shop_id = $col['shop_id'];

                            $post = $MySQLiconn->query("SELECT * FROM onemart_post where id = '$post_id' ");
                            $row=$post->fetch_array();

                            $acc = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$shop_id' ");
                            $ac=$acc->fetch_array();

                            $no++;
                        ?>
                            <tr>
                                <th scope="row"> <?php echo $no; ?>. </th>
                                <th scope="row"> <?php echo $ac['shop_name']; ?> </th>
                                <th scope="row" style="text-align: center;"> 
                                    <a href="tel:<?php echo $ac['phone']; ?>" style="color: red;font-size: 20px;">
                                        <i class="fa fa-phone"> </i> 
                                    </a>
                                </th>
                                <th scope="row"> <?php echo $row['name']; ?> </th>
                                <th scope="row"> <?php echo number_format($qty); ?></th>
                                <th scope="row"> <?php echo number_format($row['price']); ?> KS</th>
                                <th scope="row"> <?php echo number_format($row['price'] * $qty); ?> KS</th>       
                            </tr>

                      <?php
                            $total += $row['price'] * $qty;
                        } 
                       ?>
                            <tr>
                                <td colspan="6" style="color: #02b875; font-weight: bold; font-size: 17px;text-align: right;"> Total: </td>
                                <td colspan="" style="color: #02b875; font-weight: bold; font-size: 17px;text-align: left;"> <?php echo number_format($total); ?> KS </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Container fluid  -->

        <?php
            $result = $MySQLiconn->query("SELECT id FROM onemart_acc WHERE phone = '".$phone."' LIMIT 1 ");
            $row = $result->fetch_array();
        ?>
            
        <a href="receive_thanks.php?uid=<?php echo $row['id']; ?>">
            <div class="fixed-bottom">
                <div class="row w3-card-12" style="height: 50px; line-height: 50px; text-align: center; font-size: 16px;">
                    <div class="col-12 zawgyi" style="background-color:#02b875;color: white;">
                        <i class="fa fa-check"> </i>  👍ပစၥည္​းလက္​ခံရရိွပါသည္​👍
                    </div>
                </div>
            </div>
        </a>

        <?php }else { ?>
 
        <p class="zawgyi" style="color: #02b875;text-align: center;margin-top: 40px;font-size: 22px; font-weight: bold;"> 
                လူႀကီးမင္​း ဝယ္​ယူထား​ေသာ ပစၥည္​းမရိွပါဘူး ခင္​ဗ် 🙌
        </p>
    
        <p class="zawgyi" style="color: #000;text-align: center;margin-top: 25px;font-size: 17px; font-weight: bold;"> 
            ပစၥည္​းမ်ားဝယ္​ယူလိုပါက <i class="fa fa-right-arrow"></i> <a href="index.php" style="text-decoration: underline;color: #006698;"> OneMart Online Shopping & Delivery Service </a>
        </p>
 
        <?php } ?>
 
 
 

    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>

     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- other js -->
    <!-- All Jquery -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>

    <!-- end other js -->
 
  </body>
</html>
