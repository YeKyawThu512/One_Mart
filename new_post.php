<?php 
include("header.php");
 
if(!empty($shop_name)) 
{
    if(isset($_POST['insert']))
    {       
             
        $shop_id     = test_input(mysqli_real_escape_string($MySQLiconn,$_POST["shop_id"])); 
        $name        = test_input(mysqli_real_escape_string($MySQLiconn,$_POST["val-name"])); 
        $price       = test_input(mysqli_real_escape_string($MySQLiconn,$_POST["val-price"]));
        $category    = test_input(mysqli_real_escape_string($MySQLiconn,$_POST["val-category"])); 
        $delivery    = test_input(mysqli_real_escape_string($MySQLiconn,$_POST["val-delivery"])); 
        $strike      = test_input(mysqli_real_escape_string($MySQLiconn,$_POST["val-strike"]));
        $description = test_input(mysqli_real_escape_string($MySQLiconn,$_POST["val-description"]));
        
        if(isset($_POST["taker"]))
        {
            $taker = 1;
        } else {
            $taker = 0;
        }

        $img1                   = $_FILES['val-img1']['name'];
        $tempo1                 = $_FILES['val-img1']['tmp_name'];

        if($img1) 
        {
            move_uploaded_file($tempo1, "post/$img1");
        }       

        $img2                   = $_FILES['val-img2']['name'];
        $tempo2                 = $_FILES['val-img2']['tmp_name'];

        if($img2) 
        {
            move_uploaded_file($tempo2, "post/$img2");
        }

        $img3                  = $_FILES['val-img3']['name'];
        $tempo3                = $_FILES['val-img3']['tmp_name'];

        if($img3) 
        {
            move_uploaded_file($tempo3, "post/$img3");
        }

        $img4                   = $_FILES['val-img4']['name'];
        $tempo4                 = $_FILES['val-img4']['tmp_name'];

        if($img4) 
        {
            move_uploaded_file($tempo4, "post/$img4");
        }

        $img5                   = $_FILES['val-img5']['name'];
        $tempo5                 = $_FILES['val-img5']['tmp_name'];

        if($img5) 
        {
            move_uploaded_file($tempo5, "post/$img5");
        }
        
        $MySQLiconn->query("INSERT INTO onemart_post(name, price, strike, description, category_id, delivery, img1, img2, img3, img4, img5, shop_id, taker, created_date, modified_date) VALUES('".$name."', '".$price."', '".$strike."', '".$description."', '".$category."', '".$delivery."', '".$img1."', '".$img2."', '".$img3."', '".$img4."', '".$img5."', '".$shop_id."', '".$taker."', now(), now())");        
    ?>
        <script>   
            window.location.href='index.php';
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
        .fa-stack[data-count]:after{
      position:absolute;
      right:0%;
      top:1%;
      content: attr(data-count);
      font-size:40%;
      padding:.6em;
      border-radius:999px;
      line-height:.75em;
      color: white;
      background:#006698;
      text-align:center;
      min-width:2em;
      font-weight:bold;
    }

    .zawgyi {
       font-family:Zawgyi-One;
    }
    .unicode {
       font-family:Myanmar3,Yunghkio,'Masterpiece Uni Sans';
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 55px;
      height: 28px;
    }

    .switch input { 
     opacity: 0;
     width: 0;
     height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #02b875;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #02b875;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

    </style>
  </head>
    <body>
        <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
            <header class="demo-header mdl-layout__header" style="background-color: #02b875; color: white;">
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title">New Post</span>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                        <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                            <i class="material-icons">search</i>
                        </label>
                        <div class="mdl-textfield__expandable-holder">
                            <form name="search" action="index.php" method="get" >
                                <input name="kk" class="mdl-textfield__input" type="text" id="search">
                                <label class="mdl-textfield__label" for="search"></label>
                            </form>
                        </div>
                    </div>
                    <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" href="new_post.php" id="">
                        <i class="material-icons">refresh</i>
                    </a>
                </div>
            </header>
        
        <!-- nav -->
        <?php include("nav.php"); ?>
        <!-- end nav -->
      
        <main class="mdl-layout__content mdl-color--grey-100">
            <div class="mdl-grid demo-content">
                <!-- Container fluid  -->
                <div class="container-fluid">
                    <h4 style="color: red; font-size: 15px;text-align: center;">
                    <?php
                    if(empty($shop_name)) 
                    {
                    ?>
                        ** You must enter your shop information before selling product. **
                    <?php
                    }
                    ?>
                   </h4>
                    <!-- Start Page Content -->
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <p style="text-align:center;font-weight:bold;font-size: 16px;margin-bottom: 20px;"> 
                                        <span class="text-danger">*</span> Required
                                    </p>
                                    <div class="form-validation">
                                        <form class="form-valide" action="new_post.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                            
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-name">Product Name:
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control zawgyi" id="val-name" name="val-name" placeholder="Your Product name..">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-price"> Current Price: 
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="number" value="" class="form-control zawgyi" id="val-price" name="val-price" placeholder="10000">  
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-strike"> Previous Price: 
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="number" value="" class="form-control zawgyi" id="val-strike" name="val-strike" placeholder="10000">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-category"> Category 
                                                    <span class="text-danger">*</span>
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
                                                <label class="col-lg-4 col-form-label" for="val-delivery"> Delivery 
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="val-delivery" name="val-delivery">
                                                        <option value=""> choose  </option>
                                                        <option value="1"> One Mart Delivery</option>
                                                        <option value="2"> Own Delivery</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-description">Product Description:
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">    
                                                    <textarea type="text" class="form-control zawgyi" rows="5" id="val-description" name="val-description" placeholder="Your Product Description."></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-img1"> Photo: 
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="file" class="form-control" id="val-img1" name="val-img1" accept="image/*">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-img2"> Photo: 
                                                    <span class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="file" class="form-control" id="val-img2" name="val-img2" accept="image/*">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-img3"> Photo: 
                                                    <span class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="file" class="form-control" id="val-img3" name="val-img3" accept="image/*">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-img4"> Photo: 
                                                    <span class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="file" class="form-control" id="val-img4" name="val-img4" accept="image/*">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-img5"> Photo: 
                                                    <span class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="file" class="form-control" id="val-img5" name="val-img5" accept="image/*">
                                                </div>
                                            </div>

                                            <input type="hidden" class="form-control" id="" value="<?php echo $id; ?>" name="shop_id">
                                            
                                            <!-- order taker -->
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-img5"> Allow Order Taking: 
                                                    <span class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <label class="switch">
                                                        <input name="taker" type="checkbox"> 
                                                        <span class="slider round"></span>
                                                    </label> 
                                                </div>
                                            </div>
                                            <!-- end order taker -->

                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" name="insert" class="btn" style="background-color: #02b875;color: white;">Submit
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
                    "val-description": {
                        required: !0,
                        minlength: 5
                    },
                    "val-category": {
                        required: !0
                    },
                    "val-delivery": {
                        required: !0
                    },
                    "val-price": {
                        required: !0,
                        minlength: 1,
                        maxlength: 7, 
                        digits: !0
                    },
                    "val-strike": {
                        required: !0,
                        minlength: 1,
                        maxlength: 7, 
                        digits: !0
                    },
                    "val-img1": {
                        required: !0
                    }
                },
                messages: {
                    "val-name": {
                        required: "Please enter your product name.",
                        minlength: "Your product name must consist of at least 3 characters."
                    },
                    "val-description": {
                        required: "Please enter your product description.",
                        minlength: "Your product description must consist of at least 5 characters."
                    },
                    "val-price": {
                        required: "Please enter current price.",
                        minlength: "Your current price must consist of at least 1 number.",
                        maxlength: "Maximum 7 numbers.",
                        digits:     "Please enter between 0 and 9."
                    },
                    "val-strike": {
                        required: "Please enter previous price.",
                        minlength: "Your previous price must consist of at least 1 number.",
                        maxlength: "Maximum 7 numbers.",
                        digits:    "Please enter between 0 and 9."
                    },
                    
                    "val-img1": "Please upload product photo."

                    
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
  </body>
</html>