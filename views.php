<?php
include("header.php");

$MySQLiconn->query("UPDATE onemart_view SET status = '0'  WHERE shop_id ='$id'"); 
$MySQLiconn->query("UPDATE onemart_save SET status = '0'  WHERE shop_id ='$id'"); 

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

    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/w3.css" rel="stylesheet">

    <!-- myanmar -->
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' />  
    <!-- myanmar -->

    <style>
        .fa-stack[data-count]:after {
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
                <span class="mdl-layout-title"> View & Save List</span>
                <div class="mdl-layout-spacer"></div>      
            </div>
        </header>
      
        <!-- nav -->
        <?php include("nav.php"); ?>
        <!-- end nav -->
        
        <main class="mdl-layout__content mdl-color--grey-100">
            <div class="">
                <!-- tab -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-b-0">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    
                                    <li class="nav-item col-6" style="text-align: center;"> 
                                        <a class="nav-link active" data-toggle="tab" href="#view" role="tab">
                                            <span class="hidden-sm-up"><i class="fa fa-eye"></i></span> 
                                            <span class="hidden-xs-down">Views</span>
                                        </a> 
                                    </li>
                                
                                    <li class="nav-item col-6" style="text-align: center;">
                                        <a class="nav-link" data-toggle="tab" href="#save" role="tab">
                                            <span class="hidden-sm-up"><i class="fa fa-bookmark"></i></span> 
                                            <span class="hidden-xs-down">Saved</span>
                                        </a> 
                                    </li>     
                                </ul>
                                
                                <div class="tab-content">
                                    <!-- views -->
                                    <div class="tab-pane active" id="view" role="tabpanel">
                                        <!-- Container fluid  -->
                                        <div class="container-fluid">
                                            <!--  list -->
                                            <div class="card-body" style="margin-bottom: 20px;">
                                                <div class="recent-meaasge">
                                                <?php
                                                    $result = $MySQLiconn->query("SELECT * FROM onemart_view where shop_id = '$id' order by created_date desc");

                                                    while($col=$result->fetch_array()) 
                                                    {

                                                        $user_id = $col['user_id'] ; 
                                                        $pp = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$user_id' ");
                                                        $pro=$pp->fetch_array();
                                                        $page_id = $col['post_id'] ; 
                   
                                                        $pag = $MySQLiconn->query("SELECT * FROM onemart_post where id = '$page_id'");
                                                        $pagg=$pag->fetch_array();
                                                ?>
                                                
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="#"><img alt="..." src="profile/<?php echo $pro['profile']; ?>" class="demo-avatar"></a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading zawgyi"> 
                                                                <?php echo $pro['username']; ?> &nbsp; <i style="color: #02b875;" class="fa fa-eye"> </i>. <?php echo $col['count']; ?> 
                                                            </h4>
                          
                                                            <p style="font-size: 13px;margin-left: 0px;" class="zawgyi">
                                                                <?php echo $pagg['name']; ?>
                                                                
                                                            </p>
                          
                                                            <p style="" class="f-s-12 zawgyi">
                                                                <time class="timeago" datetime="<?php echo $col['created_date']; ?>"></time>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <!-- end  list -->      
                                    </div>
                                    <!-- End Container fluid  -->
                                </div>
                                <!-- end views -->
                                
                                <!-- views -->
                                <div class="tab-pane" id="save" role="tabpanel">
                                    <!-- Container fluid  -->
                                    <div class="container-fluid">
                                        <!--  list -->
                                        <div class="card-body" style="margin-bottom: 20px;">
                                            <div class="recent-meaasge">
                                            <?php
                                                $result = $MySQLiconn->query("SELECT * FROM onemart_save where shop_id = '$id' order by created_date desc");

                                                while($col=$result->fetch_array()) 
                                                {
                                                    $user_id = $col['user_id'] ; 
                                                    $pp = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$user_id' ");
                                                    $pro=$pp->fetch_array();

                                                    $page_id = $col['post_id'] ; 
                                               
                                                    $pag = $MySQLiconn->query("SELECT * FROM onemart_post where id = '$page_id'");
                                                    $pagg=$pag->fetch_array();
                                            ?>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img alt="..." src="profile/<?php echo $pro['profile']; ?>" class="demo-avatar">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading zawgyi"> 
                                                        <?php echo $pro['username']; ?> &nbsp;
                                                         <i style="color: #02b875;" class="fa fa-bookmark"> </i>
                                                    </h4>
                                                    <p style="" class="f-s-12 zawgyi">
                                                        <time class="timeago" datetime="<?php echo $col['created_date']; ?>"></time>
                                                        <p style="font-size: 13px;margin-left: 25px;" class="w3-tag w3-blue zawgyi">
                                                            <?php echo $pagg['name']; ?>

                                                        </p>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- end  list -->    
                            </div>
                            <!-- End Container fluid  -->
                        </div>
                        <!-- end save -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end tab -->

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

    <!-- time ago js -->
    <script src="js/timeago.js"></script>
    <!-- end time ago js -->
      
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