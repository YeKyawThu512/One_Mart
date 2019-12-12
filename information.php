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
            alert('Your shop is successfully created. Good Luck.');
            window.location.href='my_wall.php?uid=<?php echo $id; ?>'; 
        </script>


    <?php 
    }       
}
   
    function test_input($inputField){
       
        $inputField = htmlspecialchars(stripcslashes(strip_tags($inputField)));
        return $inputField;
       
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
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> 
    <!-- bootstrap css -->

     <!-- Bootstrap Core CSS -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/w3.css" rel="stylesheet">
     <!-- bootstrap css -->
     
    <!-- myanmar -->
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' />  
    <!-- myanmar -->
     
    <style>
   
    .zawgyi {
        font-family:Zawgyi-One;
    }
    .unicode {
        font-family:Myanmar3,Yunghkio,'Masterpiece Uni Sans';
    }

    </style>
    </head>
    <body>
        <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
            <header class="demo-header mdl-layout__header" style="background-color: #02b875; color: white;">
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title">Shop Information</span>
                    <div class="mdl-layout-spacer"></div>        
                </div>
            </header>
            
            <!-- nav -->
            <?php include("nav.php"); ?>
            <!-- end nav -->
      
            <main class="mdl-layout__content mdl-color--grey-100">
                <div class="mdl-grid demo-content">
                    <!-- Container fluid  -->
                    <div class="container-fluid">
                        <!-- Start Page Content -->
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <p style="text-align:center;font-weight:bold;font-size: 16px;color:black;"> 
                                            <span class="text-danger">*</span> Required
                                        </p>

                                        <div class="form-validation">
                                            <form class="form-valide" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                            
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-name">
                                                    Shop Name:<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control zawgyi" id="val-name" name="val-name" placeholder="Your Shop name..">
                                                </div>
                                            </div>
                                        
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-address">
                                                    Shop Address:<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">    
                                                    <textarea type="text" class="form-control zawgyi" rows="5" id="val-address" name="val-address" placeholder="Your Shop Address"></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-category"> 
                                                    Category: <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="val-category" name="val-category">
                                                        <option value=""> choose  </option>
                                                        <?php
                                                        $cat = $MySQLiconn->query("SELECT * FROM onemart_category");                                               
                                                        while($col=$cat->fetch_array())
                                                        {
                                                    
                                                        ?>
                                                    
                                                            <option class="" value="<?php echo $col['id']; ?>">
                                                                <?php echo $col['category']; ?>  
                                                            </option>
                                                  <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-viber">
                                                    Viber:<span class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="tel" class="form-control zawgyi" id="val-viber" name="val-viber" placeholder="09...">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-messenger">
                                                    Messenger: <span class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control zawgyi" id="val-messenger" name="val-messenger" placeholder="https://m.me/...">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-facebook">
                                                    Facebook: <span class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control zawgyi" id="val-facebook" name="val-facebook" placeholder="https://facebook.com/...">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-profile"> 
                                                    Shop Photo:<span class="text-danger">*</span>
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
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" name="insert" class="btn" style="background-color: #02b875;color: white;">
                                                            Submit
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
                </div>
                <!-- End Container fluid  -->
            </div>
        </main>
    </div>
      
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
    <script src="js/lib/form-validation/jquery.validate-init.js"></script>
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