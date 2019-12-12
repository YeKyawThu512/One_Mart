<?php
include("header.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <title> One Mart </title>
    <meta name="description" content="One of the best Myanmar Online Marketplace.">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="shortcut icon" href="logo/My Drawing (JPG).jpg">

    <!-- myanmar -->
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' />  
    <!-- myanmar -->

     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://sdk.accountkit.com/en_US/sdk.js"></script>


<script>
  // initialize Account Kit with CSRF protection
  AccountKit_OnInteractive = function(){
    AccountKit.init(
      {
        appId:"329534654476016", 
        state:"6ced03e052894129c1a0a4279205a8c6", 
        version:"v1.1",
        fbAppEventsEnabled:true,
        redirect:"http://member20-witaward.webstarterz.com/one%20mart/receive_confirm.php"
      }
    );
  };

  // login callback
  function loginCallback(response) {
    console.log(response);
    if (response.status === "PARTIALLY_AUTHENTICATED") {
      var code = response.code;
      var csrf = response.state;
      console.log(code);
      console.log(csrf);
      document.getElementById("code").value = response.code;
      document.getElementById("csrf").value = response.state;
      document.getElementById("login_success").submit();
      // Send code to server to exchange for access token
    }
    else if (response.status === "NOT_AUTHENTICATED") {
      // handle authentication failure
    }
    else if (response.status === "BAD_PARAMS") {
      // handle bad parameters
    }
  }

  // phone form submission handler
  function smsLogin() {
    console.log(smsLogin);
    var countryCode = document.getElementById("country_code").value;
    var phoneNumber = document.getElementById("phone_number").value;
    AccountKit.login(
      'PHONE', 
      {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
      loginCallback
    );
  }

</script>

<style type="text/css">

    body{
      background-color: #fff;
      max-height: 100%;
    }

    .zawgyi {
        font-family:Zawgyi-One;
        }
    .unicode{
        font-family:Myanmar3,Yunghkio,'Masterpiece Uni Sans';
        }

</style>

</head>
    <body>
  
        <p style="color: #02b875; font-size: 22px; font-weight: bold;text-align: center;margin-top: 60px;" class="zawgyi"> 
            Product Receive Form
        </p>

        <div class="text-center" style="margin-bottom: 60px;">
            <img src="logo/onemart jpg.jpg" class="rounded img-fluid img-center" alt="..." width="160px;" height="160px;">
        </div>

        <center>
            <p>
                <input class="w3-input" value="+95" id="country_code" type="hidden" disabled="disabled" style="width: 300px;" />
                <input type="tel" class="w3-input" maxlength="12" placeholder="Enter Your Phone" style="width: 300px;" id="phone_number" required="" />
            </p> 
        </center><br>

        <center>
            <button class="w3-btn w3-text" onclick="smsLogin();" style="color:#fff;background-color: #02b875;width: 300px;"> Submit </button>
        </center>

        <center>
            <div class="alert alert-danger fixed-bottom" style="margin-top: 60px;">
                <strong>Note!!!</strong> You can't use this page because phone verification system don't support to localhost.  <a  href="receive_confirm.php"> Skip . </a> 
            </div>
        </center>
        
        <div>
            <form id="login_success" method="post" action="receive_confirm.php">
                <input id="csrf" type="hidden" name="csrf" />
                <input id="code" type="hidden" name="code" />
            </form>
        </div>
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



   

  </body>

</html>