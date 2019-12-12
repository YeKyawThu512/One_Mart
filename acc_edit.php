<?php  
include("header.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    date_default_timezone_set('Asia/Rangoon');  
    $to = date('idshym');
       
    $uname = test_input(mysqli_real_escape_string($MySQLiconn,$_POST['val-name']));
    
    $imgFile = $_FILES['val-img']['name'];
    $tmp_dir = $_FILES['val-img']['tmp_name'];
    $imgSize = $_FILES['val-img']['size'];

    if($imgFile)
    {
        $upload_dir = 'profile/'; // upload directory    
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
        $userpic = 'OneMartProfile_'.$to.rand(1000,1000000).".".$imgExt;
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
        $userpic = $profile;
    }

    
    if(empty($errMSG))
    {

        $successMSG =  $MySQLiconn->query("UPDATE onemart_acc SET username = '$uname', profile= '$userpic' WHERE id = '$id' and phone ='$phone' LIMIT 1");

    ?>

        <script>
            alert('Successfully Updated.');
            window.location.href='edit.php'; 
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
    <!-- Required meta tags -->
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
                    Edit Account
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
                        <div class="form-validation">
                            <form class="form-valide" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                                    
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-name">      Name:<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control zawgyi" id="val-name" value="<?php echo $name; ?>" name="val-name" placeholder="Your name..">
                                        </div>
                                    </div>
                                        
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-viber">     Phone:<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="tel" class="form-control" value="<?php echo $phone; ?>" placeholder="09..." disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-img"> 
                                            Profile:<span class="text-danger">*</span>
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
                                    
                                    <!-- image -->
                                    <div class="container" style="margin-top: 10px;">
                                        <div class="row">
                                            <div class="col-12">
                                                <center>
                                                    <img class="demo-avatar" src="profile/<?php echo $profile; ?>" alt="profile" style="width: 250px; height: 250px;">
                                                </center>
                                            </div>
                                        </div> 
                                    </div> <br>
                                    <!-- end image -->
                                    <div class="form-group row">
                                        <div class="col-lg-12 ml-auto">
                                            <button type="submit" name="insert" class="btn btn-block" style="background-color: #02b875;color: white;">Submit
                                            </button>
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
                        minlength: 3
                    }
                        
                },
                messages: {
                    "val-name": {
                        required: "Please enter your name.",
                        minlength: "Your name must consist of at least 3 characters."
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