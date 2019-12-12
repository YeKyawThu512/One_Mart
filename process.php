<?php
// facebook account kit integration for phone number verification 
error_reporting(0);
session_start();

include("dbcon.php");
include("hash.php");

// Initialize variables
$app_id = '*****************';
$secret = '********************';
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
    echo "<script>window.open('home.php','_self')</script>";
}
    
$result  = $MySQLiconn->query("SELECT phone FROM onemart_acc WHERE  phone='".$phone."' LIMIT 1");
$num_acc = $result->num_rows;

    if($num_acc == 1)
    {
        $row   = $result->fetch_array();
        $phone = $row['phone'];        

        $days = 90;
        $value = encryptCookie($phone);
        setcookie ("rememberme",$value,time()+ ($days *  24 * 60 * 60 ));
        echo "<script>window.open('index.php','_self')</script>";

    }  
 
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
   
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> 

    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/w3.css" rel="stylesheet">
     
    <!-- myanmar -->
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' />  
    <!-- myanmar -->


    <style>

        .zawgyi{
            font-family:Zawgyi-One;
        }
        .unicode{
            font-family:Myanmar3,Yunghkio,'Masterpiece Uni Sans';
        }

    </style>
  </head>
  <body>

    <?php if($num_acc == 0){ ?>
        
        <!-- Container fluid  -->
        <div class="container-fluid" style="margin-top: 100px;">
            <!-- Start Page Content -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card" style="border: 2px solid #02b875;">
                        <div class="card-body">
                            <p style="text-align:center;font-weight:bold;font-size: 20px;color:#02b875;margin-bottom: 30px;"> 
                                Register
                            </p>
                            <div class="form-validation">
                                <form class="form-valide" action="user_add.php" method="post" enctype="multipart/form-data">
                                    
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-name">      Your Name:<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control zawgyi" id="val-name" name="val-name" placeholder="Enter Your Name..">
                                        </div>
                                    </div>
                                        
                                    <input type="hidden" value="<?php echo $phone; ?>" class="form-control" id="val-phone" name="val-phone" placeholder=""> 

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-img"> 
                                            Your Profile:<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6 custom-file">
                                            <input type="file" class="form-control text custom-file-input" id="file" name="val-img" accept="image/*" onchange="return fileValidation()">
                                            <label class="custom-file-label" for="customFile">
                                                Choose file
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Image preview -->
                                            <div id="imagePreview"></div>
                                        </div>
                                        <div class="col-lg-2">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-6">
                                            <button type="submit" name="insert" class="btn btn-block" style="background-color: #02b875;color: white;">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->

    <?php } else {
    
        echo "<script>window.open('home.php','_self')</script>";
    }

?>

      
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
 <!-- Form validation -->
    <script src="js/lib/form-validation/jquery.validate.min.js"></script>
    <script type="text/javascript">
        
var form_validation = function() {
    var e = function() {
            jQuery(".form-valide").validate({
                ignore: [],
                errorClass: "invalid-feedback animated fadeInDown",
                errorElement: "div",
                errorPlacement: function(e, a) {
                    jQuery(a).parents(".form-group > div").append(e)
                },
                highlight: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                },
                rules: {
                    "val-name": {
                        required: !0,
                        minlength: 3
                    },
                    "val-phone": {
                        required: !0,
                        minlength: 8,
                        maxlength: 14 
                        
                    },
                    "val-img": {
                        required: !0
                    }
                },
                messages: {
                    "val-name": {
                        required: "Please enter your name.",
                        minlength: "Your name must consist of at least 3 characters."
                    },
                    "val-phone": {
                        required: "Please enter your phone number.",
                        minlength: "Your phone number must consist of at least 8 number.",
                        maxlength: "Maximum 14 numbers."
                        
                    },
                    
                    "val-img": "Please upload your Profile."

                    
                }
            })
        }
    return {
        init: function() {
            e(), a(), jQuery(".js-select2").on("change", function() {
                jQuery(this).valid()
            })
        }
    }
}();
jQuery(function() {
    form_validation.init()
});
    </script>

    <!-- end form validation -->

    <!-- file extension -->
    <script type="text/javascript">
    function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .jpeg/.jpg/.png only.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'" style="height:200px;widht:200px;" />';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}
    </script>


  </body>
</html>
