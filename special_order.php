<?php  
include("header.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    date_default_timezone_set('Asia/Rangoon');  
    $today = date('d-m-Y h:i:sa');
        
    $uname = test_input(mysqli_real_escape_string($MySQLiconn,$_POST['val-name']));
    $udesc = test_input(mysqli_real_escape_string($MySQLiconn,$_POST['val-desc']));

    $imgFile = $_FILES['val-photo']['name'];
    $tmp_dir = $_FILES['val-photo']['tmp_name'];
    $imgSize = $_FILES['val-photo']['size'];

    if($imgFile)
    {
        $upload_dir = 'special order/'; // upload directory    
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
        $userpic = 'Special_Order_'.$to.rand(1000,1000000).".".$imgExt;
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
            $errMSG = "Invalid file format.";        
        }   
    }
    
    if(empty($errMSG))
    {
        $MySQLiconn->query("INSERT INTO onemart_special(user_id, name, description, photo, created_date) VALUES('".$id."', '".$uname."', '".$udesc."', '".$userpic."', '".$today."')");
    }
?>

    <script>
        alert('Your Special Order is delivered. We will contact soon.');
        window.location.href='index.php'; 
    </script>


<?php 
}
   
function test_input($inputField)
{      
    $inputField = htmlspecialchars(stripcslashes(strip_tags($inputField)));
    return $inputField;       
}
 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="One of the best Myanmar Online Marketplace.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="shortcut icon" href="logo/My Drawing (JPG).jpg">
    
    <!-- myanmar -->
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' />  
    <!-- myanmar -->

    <title>One Mart</title>
    
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

    <div class="fixed-top">
        <div class="row w3-card-4" style="background-color: #02b875; color: white; height: 60px; line-height: 60px; text-align: center; font-size: 19px;">
            <div class="col-2">
                <a href="#" onclick="goBack()" style="text-align: center;color: white;background-color: #02b875;">
                    <i class="fa fa-arrow-left"> </i>
                </a>    
            </div>
            <div class="col-10">
                <p class="text-justify zawgyi" style="color:white;text-align: center;">
                    Special Order
                </p>
            </div>
        </div>
    </div>


    <!-- Container fluid  -->
    <div class="container-fluid" style="margin-top: 70px;">
        <!-- Start Page Content -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            <p style="text-align:center;font-weight:bold;font-size: 16px;margin-bottom: 20px;"> 
                                <span class="text-danger">*</span> Required
                            </p>

                            <div class="form-validation">
                                <form class="form-valide" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-name" style="color:#02b875;font-weight: bold;">
                                                Product Name:
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control zawgyi" id="val-name" value="" name="val-name" placeholder="Laptop အိတ္">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-desc" style="color:#02b875;font-weight: bold;">      Product Description:
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <textarea type="text" class="form-control zawgyi" rows="10" cols="10" id="val-desc" name="val-desc" placeholder="(size,color,price,description)"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label label" for="val-photo" style="color:#02b875;font-weight: bold;">
                                                Product Photo:
                                            </label> 
                                            <div class="col-lg-6 custom-file">
                                                <input type="file" class="form-control text custom-file-input" id="file" name="val-photo" accept="image/*" onchange="return fileValidation()">
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
                                            <label class="col-lg-4 col-form-label" for="">      
                                            </label>
                                            <div class="col-lg-6">
                                                <p style="color:#006698;font-size: 15px;text-align:center;" class="zawgyi">
                                                    ** လူႀကီးမင္​း မွာယူလို​ေသာပစၥည္​းႏွင္​့သက္​ဆိုင္​သည္​့ အခ်က္​အလက္​မ်ားကို ျပည္​့စံုစြာ ထည္​့သြင္​း​ေပးပါ။
                                                </p>
                                                <p style="color:#006698;font-size: 15px;text-align:center;" class="zawgyi">
                                                    ** ပစၥည္​းတန္​ဖိုး၏ က်သင္​့​ေငြ ၅၀ ရာခိုင္​ႏႈန္​း ႀကိဳတင္​​ေပး​ေခ် ပီးမွာယူႏိုင္​သည္​။
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-lg-12 ml-auto">
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
            </div><br/><br/>
            <!-- End Container fluid  -->
 
            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
   
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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
                    "val-desc": {
                        required: !0,
                        minlength: 5
                    },
                    "val-name": {
                        required: !0
                    }
                        
                },
                messages: {
                    "val-address": {
                        required: "Please enter your product description.",
                        minlength: "Your product description must consist of at least 5 characters."
                    }
                    
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
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'" style="height:150px;widht:150px;" />';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}
    </script>
    
  </body>
</html>