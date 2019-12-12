<?php  
include("header.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    date_default_timezone_set('Asia/Rangoon');  
    $to = date('idshym');
       
    $sname      = test_input(mysqli_real_escape_string($MySQLiconn,$_POST['val-name']));
    $saddress   = test_input(mysqli_real_escape_string($MySQLiconn,$_POST['val-address']));
    $scategory  = test_input(mysqli_real_escape_string($MySQLiconn,$_POST['val-category']));
    $sviber     = test_input(mysqli_real_escape_string($MySQLiconn,$_POST['val-viber']));
    $smessenger = test_input(mysqli_real_escape_string($MySQLiconn,$_POST['val-messenger']));
    $sfacebook  = test_input(mysqli_real_escape_string($MySQLiconn,$_POST['val-facebook']));
    
    $imgFile = $_FILES['val-profile']['name'];
    $tmp_dir = $_FILES['val-profile']['tmp_name'];
    $imgSize = $_FILES['val-profile']['size'];

    if($imgFile)
    {
        $upload_dir = 'shop_profile/'; // upload directory    
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
        $userpic = 'OneMartShop_'.$to.rand(1000,1000000).".".$imgExt;
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
    else
    {
        $userpic = $shop_photo;
    }

    if(empty($errMSG))
    {

        $successMSG =  $MySQLiconn->query("UPDATE onemart_acc SET shop_name = '$sname', address= '$saddress', category= '$scategory', viber='$sviber', messenger='$smessenger', facebook= '$sfacebook', shop_photo= '$userpic' WHERE id = '$id' and phone ='$phone' LIMIT 1");

    ?>

        <script>
            alert('Successfully Updated.');
            window.location.href='my_wall.php?uid=<?php echo $id; ?>'; 
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

<!doctype html>
<html lang="en">
  <head>
    <title>One Mart</title>
    <meta charset="utf-8">
    <meta name="description" content="One of the best Myanmar Online Marketplace.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="shortcut icon" href="logo/My Drawing (JPG).jpg">
    
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

    <div class="fixed-top">
        <div class="row w3-card-4" style="background-color: #02b875; color: white; height: 60px; line-height: 60px; text-align: center; font-size: 19px;">
            <div class="col-2">
                <a href="#" onclick="goBack()" style="text-align: center;color: white;background-color: #02b875;">
                    <i class="fa fa-arrow-left"> </i>
                </a>
            </div>
            <div class="col-10">
                <p class="text-justify zawgyi" style="color:white;text-align: center;">
                    Edit Shop Account
                </p>
            </div>
        </div>
    </div>
    
    <!-- Container fluid  -->
    <div class="container-fluid" style="margin-top: 70px;">
        <p style="text-align: center;color:red;font-size: 17px;"> 
            <?php 
                if(isset($errMSG))
                {
                    echo $errMSG;
                }
            ?>
        </p>
        <!-- Start Page Content -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        
                        <p style="text-align:center;font-weight:bold;font-size: 16px;"> 
                            <span class="text-danger">*</span> Required
                        </p>
                                 
                        <div class="form-validation">
                            <form class="form-valide" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" autocomplete="off" enctype="multipart/form-data">

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-name" style="color:#02b875;font-weight: bold;">
                                        Shop Name:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control zawgyi" id="val-name" value="<?php echo $shop_name; ?>" name="val-name" placeholder="Your Shop name..">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-address" style="color:#02b875;font-weight: bold;">
                                        Shop Address:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control zawgyi" id="val-address" value="<?php echo $address; ?>" name="val-address" placeholder="Your Shop address..">    
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-category" style="color:#02b875;font-weight: bold;">      
                                        Category 
                                        <span class="text-danger">*</span>
                                    </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" id="val-category" name="val-category">

                                            <?php
                                                $old = $MySQLiconn->query("SELECT * FROM onemart_category where id = '$category'");                                               
                                                $old_cat=$old->fetch_array();
                                            ?>
                                                <option value="<?php echo $old_cat['id']; ?>">      <?php echo $old_cat['category']; ?>  
                                                </option>
                                                    
                                            <?php
                                                $cat = $MySQLiconn->query("SELECT * FROM onemart_category");                                               
                                                while($col=$cat->fetch_array())
                                                {
                                                    
                                            ?>   
                                                <option value="<?php echo $col['id']; ?>">
                                                    <?php echo $col['category']; ?>  
                                                </option>
                                            
                                            <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                              
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-viber" style="color:#02b875;font-weight: bold;">     
                                            Viber:
                                            <span class="text-danger"></span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="tel" class="form-control zawgyi" id="val-viber" value="<?php echo $viber; ?>" name="val-viber" placeholder="09...">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-messenger" style="color:#02b875;font-weight: bold;">
                                            Messenger: 
                                            <span class="text-danger"></span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control zawgyi" id="val-messenger" value="<?php echo $messenger; ?>" name="val-messenger" placeholder="https://m.me/...">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-facebook" style="color:#02b875;font-weight: bold;"> Facebook: 
                                            <span class="text-danger"></span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control zawgyi" id="val-facebook" value="<?php echo $facebook; ?>"  name="val-facebook" placeholder="https://facebook.com/...">
                                        </div>
                                    </div>      

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label label" for="val-profile" style="color:#02b875;font-weight: bold;">
                                            Shop Profile:
                                        </label> 
                                        <div class="col-lg-6 custom-file">
                                            <input type="file" class="form-control text custom-file-input" id="file" name="val-profile" accept="image/*" onchange="return fileValidation()">
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
                    "val-name": {
                        required: !0,
                        minlength: 2
                    },
                    "val-address": {
                        required: !0,
                        minlength: 5
                    },
                    "val-category": {
                        required: !0
                    }
                },
                messages: {
                    "val-name": {
                        required: "Please enter your shop name.",
                        minlength: "Your shop name must consist of at least 2 characters."
                    },
                    "val-address": {
                        required: "Please enter your shop address.",
                        minlength: "Your shop address must consist of at least 5 characters."
                    },
                    
                    "val-category": "Please select category."
                   

                    
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