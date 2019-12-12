<?php
include("header.php");
$cate = $MySQLiconn->query("SELECT * FROM onemart_category order by id asc");     
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
    <link rel="stylesheet" href="css/w3.css">
    <link rel="shortcut icon" href="logo/My Drawing (JPG).jpg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous"> 
    <!-- Bootstrap css -->

    <!-- myanmar -->
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' />  
    <!-- myanmar -->

    <style>
        .card {
          border: 1px solid #02b875;
          margin: 10px;
          width: 100%;
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
        <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
            <header class="demo-header mdl-layout__header" style="background-color: #02b875; color: white;">
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title">Categories</span>
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
                        <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" href="index.php" id="">
                            <i class="material-icons">refresh</i>
                        </a>
                    </div>
                </header>
            
            <!-- nav -->
            <?php include("nav.php"); ?>
            <!-- end nav -->
      
            <main class="mdl-layout__content mdl-color--grey-100">
                <div class="mdl-grid demo-content"> 
                    <!-- card -->
                    <div class="container">
                        <div class="row-height">
                            <div class="row">
                                <?php  while($col=$cate->fetch_array()) {  ?>
                                    <div class="col-height col-middle col-xs-5 card">
                                        <div class="col-xs-12 text-center">
                                            <h3 class="heading-s1" style="color: #02b875;">
                                                <i class="fa fa-<?php echo $col['icon']; ?>"> </i>
                                            </h3>
                                        </div>
                                        <div class="col-xs-12 text-center">
                                            <a href="index.php?cat=<?php echo $col['id']; ?>" class="btn big-btn no-border red-background unstyle-anchor" style="padding: 13px 30px;color: #02b875;">
                                                <?php echo $col['category']; ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </main>
        </div>
      
    <!-- floating shopping cart -->
    <?php
        $cart=$MySQLiconn->query("SELECT id FROM onemart_tempo where user_id = '$id' and cart = '1' ");
        $count = $cart->num_rows;
        if($count > 0) {
    ?>
        <a href="cart.php" target="" id="view-source" class="" style="font-size: 18px; text-decoration: none;">
            <span class="dot">
              <i class="fa fa-shopping-cart" style="color: white;margin-top: 20px;"></i>
              <sup style="color: white; font-size: 14px;"><?php echo $count; ?></sup>   
           </span> 
        </a>
    <?php } ?>
    <!-- end floating shopping cart -->
      
    
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>

     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>
