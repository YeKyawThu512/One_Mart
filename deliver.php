<?php
include("header.php");

$cart = $MySQLiconn->query("SELECT * FROM onemart_tempo where shop_id = '$id' and cart = '0' and order_id = '1' and pending = '0' order by created_date desc");

$count = $cart->num_rows;

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
    <link rel="stylesheet" href="w3.css">

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

        td.hash {
          color: #000;
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
        <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
            <header class="demo-header mdl-layout__header" style="background-color: #02b875; color: white;">
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title zawgyi"> <?php echo $shop_name; ?> </span>
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
                    
                    <!-- shopping cart -->
                    <a href="#" style="margin-left: 10px;">
                        <span style="font-size: 22px;" class="fa-stack fa-x has-badge" data-count="<?php echo $count; ?>">
                            <i class="fa fa-shopping-cart fa-stack-x fa-inverse"></i>
                        </span>
                    </a>
                    <!-- end shopping cart -->
                </div>
            </header>
      
        <!-- nav -->
        <?php include("nav.php"); ?>
        <!-- end nav -->
      
        <main class="mdl-layout__content mdl-color--grey-100">
            <div class="mdl-grid demo-content">

                <!-- alert -->
                <?php if (!empty($success)) { ?>
                    <div class="alert alert-info" role="alert" style="color: #000;">
                        <?php echo $success; ?> &nbsp;  <a style="text-decoration: none;" href="index.php"> Back </a>
                    </div>
                <?php } ?>
                <!-- end alert -->

                <!-- Container fluid  -->
                <div class="container-fluid">
                    <!-- start deliver -->
                    <p class="zawgyi" style="font-size: 16px; font-weight: bold; color: red;text-align: center;margin-top: 15px;"> 
                        ပစၥည္​း​ေပးပို႔ဆဲ ( Deliver List ) &nbsp; <?php echo $count; ?> 
                    </p><br/>
              
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Customer Name </th>
                                <th scope="col">Customer Phone </th>
                                <th scope="col"> Date </th>
                                <th scope="col"> Status </th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $no     = 0;
                            $total  = 0;
                            while($cod=$cart->fetch_array()) 
                            { 

                                $qty     = $cod['qty'];
                                $post_id = $cod['post_id'];
                                $user_id = $cod['user_id'];

                                $pos = $MySQLiconn->query("SELECT * FROM onemart_post where id = '$post_id' ");
                                $col=$pos->fetch_array();

                                $acc = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$user_id' ");
                                $cc=$acc->fetch_array();

                                $no++;

                        ?>
                            <tr>
                                <th scope="row"> <?php echo $no; ?> </th>

                                <td class="hash zawgyi"> <?php echo $col['name']; ?> </td>

                                <td class="hash"> <?php echo number_format($qty); ?> </td>

                                <td class="hash"> 
                                    <?php echo number_format($col['price']); ?> KS
                                </td>

                                <td class="hash"> 
                                    <?php echo number_format($col['price'] * $qty); ?> KS
                                </td>

                                <td class="hash zawgyi"> <?php echo $cc['username']; ?> </td>

                                <td class="hash" style="text-align: center;"> 
                                    <a href="tel:<?php echo $cc['phone']; ?>" style="color: green;font-size: 20px;">
                                        <i class="fa fa-phone"> </i> 
                                    </a>
                                </td>

                                <td class="hash"> 
                                    <time class="timeago" datetime="<?php echo $cod['created_date']; ?>"></time>
                                </td>

                                <td class=""> 
                                    <p class="zawgyi" style="color: red; font-size: 15px;font-weight: bold; text-align: center;"> ​ေပးပို႔ဆဲ </p>
                                </td>  
                            </tr>

                        <?php
                            $total += $col['price'] * $qty;
                        } 
                        ?>
                            <tr>
                                <td colspan="4" style="color: #02b875; font-weight: bold; font-size: 17px;text-align: right;"> 
                                    Total: 
                                </td>
                                <td colspan="2" style="color: #02b875; font-weight: bold; font-size: 17px;text-align: left;"> 
                                    <?php echo number_format($total); ?> KS 
                                </td>
                            </tr>
    
                        </tbody>
                    </table>
                
                <!-- start delivered -->
                <?php

                    $deli = $MySQLiconn->query("SELECT * FROM onemart_tempo where shop_id = '$id' and cart = '0' and order_id = '0' and pending = '0' order by created_date desc");
                    $dcount = $deli->num_rows;

                ?>
                <hr><br/>
                <p class="zawgyi" style="font-size: 16px;font-weight: bold; color: #006698;text-align: center; ">
                    ပစၥည္​း​ေပးပို႔ခဲ့ၿပီး ( Delivered List ) &nbsp; <?php echo $dcount; ?> 
                </p><br/>
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Customer Name </th>
                            <th scope="col">Customer Phone </th>
                            <th scope="col"> Date </th>
                            <th scope="col"> Status </th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php
                        $no     = 0;
                        $total  = 0;
                        while($cod=$deli->fetch_array()) 
                        { 

                          $qty     = $cod['qty'];
                          $post_id = $cod['post_id'];
                          $user_id = $cod['user_id'];

                          $pos = $MySQLiconn->query("SELECT * FROM onemart_post where id = '$post_id' ");
                          $col=$pos->fetch_array();

                          $acc = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$user_id' ");
                          $cc=$acc->fetch_array();

                          $no++;
                    ?>
                        <tr>
                            <th scope="row"> <?php echo $no; ?> </th>

                            <td class="hash zawgyi"> <?php echo $col['name']; ?> </td>

                            <td class="hash"> <?php echo number_format($qty); ?> </td>

                            <td class="hash"> <?php echo number_format($col['price']); ?> KS</td>

                            <td class="hash"> 
                                <?php echo number_format($col['price'] * $qty); ?> KS
                            </td>

                            <td class="hash zawgyi"> <?php echo $cc['username']; ?> </td>

                            <td class="hash" style="text-align: center;"> 
                                <a href="tel:<?php echo $cc['phone']; ?>" style="color: green;font-size: 20px;">
                                    <i class="fa fa-phone"> </i> 
                                </a>
                            </td>

                            <td class="hash"> 
                                <time class="timeago" datetime="<?php echo $cod['created_date']; ?>"></time> 
                            </td>
                            
                            <td class=""> 
                                <p class="zawgyi" style="color: #006698; font-size: 15px;font-weight: bold; text-align: center;"> 
                                    ​ေပးပို႔ၿပီး 
                                </p>
                            </td>
                        </tr>

                    <?php
                        $total += $col['price'] * $qty;
                    } 
                     ?>
                        <tr>
                            <td colspan="4" style="color: #02b875; font-weight: bold; font-size: 17px;text-align: right;"> 
                                Total: 
                            </td>
                            <td colspan="2" style="color: #02b875; font-weight: bold; font-size: 17px;text-align: left;"> 
                                <?php echo number_format($total); ?> KS 
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- end delivered -->     
            </div>
            <!-- End Container fluid  -->
        </div>
    </main>
</div>
    
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