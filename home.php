<?php
session_start();
include("hash.php");

// test 
if(isset($_GET['test']))
{
    $phone = "+".$_GET['test'];
    $days = 90;
    $value = encryptCookie($phone);
    setcookie ("rememberme",$value,time()+ ($days *  24 * 60 * 60 ));
    echo "<script>window.open('index.php','_self')</script>";
}

?>
<html>
  <head>
    <title> One Mart </title>
    <meta name="description" content="One of the best Myanmar Online Marketplace.">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="dss/w3.css">
    <link rel="shortcut icon" href="logo/My Drawing (JPG).jpg">

    <!-- myanmar -->
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' />  
    <!-- myanmar -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- facebook account kit sdk -->
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
            redirect:"http://member20-witaward.webstarterz.com/one%20mart/process.php"
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
    <!-- end facebook account kit sdk -->

    <style>

    body {
       background-color: #fff;
       max-height: 100%;
    }

   .title {
      text-align: center;
      font-family: Raleway, sans-serif;
      font-weight: bold;
      letter-spacing: 3px;
      font-size: 22px;
      line-height: 70px;
      padding-bottom: 0px;
      color: #02b875;
    }

    .zawgyi {
       font-family:Zawgyi-One;
    }
    .unicode {
       font-family:Myanmar3,Yunghkio,'Masterpiece Uni Sans';
    }

    </style>
  
  </head>
  
  <body>
    
    <p style="margin-top: 45px;" class="title typewrite zawgyi" data-period="2000" data-type='[ "💢အခ်ိန္​ကုန္​သက္​သာ👍", "💫လြယ္​ကူစြာ👌", "➰ ​ေရာင္​းပါ ဝယ္​ပါ➰", "1⃣One Mart မွာ 1⃣" ]'>
        <span class="wrap"></span>
    </p>

    <div class="text-center">
        <img src="logo/My Drawing (JPG).jpg" class="rounded img-fluid img-center" alt="..." width="150px;" height="150px;">
    </div>
    <br/><br/><br/>

    <p style="display: none;">
            
        <input class="w3-input " value="+95" id="country_code" type="hidden" disabled="disabled" style="width: 300px;" />
            
        <input type="tel" class="w3-input" maxlength="12" placeholder="Enter Your Phone" style="width: 300px;" id="phone_number" required="" />
    </p> 
 
    <center>
        <a href="?test=959692280652" class="btn w3-text" style="color:#fff;background-color: #02b875;width: 300px;height: 40px;"> 
            Get Started 
        </a>
    </center>
            
    <div>
        <form id="login_success" method="post" action="process.php">
            <input id="csrf" type="hidden" name="csrf" />
            <input id="code" type="hidden" name="code" />
        </form>
    </div>
    
   <!-- <center>
        <div class="alert alert-danger fixed-bottom" style="margin-top: 60px;">
            <strong>Note!!!</strong> "Get Started" Button can't work because phone verification system don't support to localhost. <a href="?test=959692787784"> Skip Page </a> or View <a target="_blank" href="http://member20-witaward.webstarterz.com/one%20mart/index.php"> One Mart </a> Hosted Website. 
        </div>
    </center> -->
    
    <p style="text-align: center;color: #02b875;font-size: 16px;font-weight: bold;" class="fixed-bottom"> 
        © 2019 All rights reserved. Developed By Rockstars Team. 
    </p>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



<!-- typewriter -->
<script>
//made by vipul mirajkar thevipulm.appspot.com
var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };
</script>
<!-- type writer -->

    </body>
</html>