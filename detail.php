<?php
include("header.php");

date_default_timezone_set('Asia/Rangoon');  
$today = date('Y-m-d h:i:s');


if(empty($_GET['pid']))
{
    header("Location: index.php");
}
else
{
    $pid  = $_GET['pid'];
    $post = $MySQLiconn->query("SELECT * FROM onemart_post where id = '$pid' ");
    $pp   = $post->fetch_array();

    $shop_id = $pp['shop_id'];
    $sh      = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$shop_id' ");
    $ss      = $sh->fetch_array();


    $view   = $MySQLiconn->query("SELECT * FROM onemart_view WHERE  user_id = '$id' AND post_id = '$pid'  LIMIT 1");
    $view_count = $view->num_rows;
    
    if($view_count == 1)
    {

        $MySQLiconn->query("UPDATE onemart_view SET count = count + '1', shop_id = '$shop_id', modified_date=now() WHERE user_id = '$id' AND post_id = '$pid' "); 

    }
    else
    {

        $MySQLiconn->query("INSERT INTO onemart_view(user_id, post_id, count, shop_id, created_date, modified_date) VALUES('".$id."', '".$pid."', '1', '$shop_id', now(), now())"); 

    }

}


if(!empty($_POST['comment']))
{
    $comment = htmlspecialchars($_POST['comment']);
    $page_id = $_POST['page_id'];

    $MySQLiconn->query("INSERT INTO onemart_comment(user_name, user_id, user_profile, comment, page_id, shop_id, created_date, modified_date) VALUES('".$name."', '".$id."', '".$profile."', '".$comment."', '".$page_id."', '".$shop_id."', '".$today."', '".$today."' )"); 
     
}

if(isset($_GET['save']))
{
    $sql = $MySQLiconn->query("INSERT INTO onemart_save(user_id, post_id, shop_id, created_date, modified_date) VALUES( '".$id."', '".$pid."', '".$shop_id."', now(), now())"); 

    if($sql)
    {
        $saveMsg = "Saved this post.";
        header("refresh:3;detail.php?pid=".$pid); // redirects page after 3 seconds.
    } 
}
       
if(isset($_GET['unsave']))
{
    $sql = $MySQLiconn->query("DELETE FROM onemart_save WHERE user_id = '$id' and post_id = '$pid' ");

    if($sql)
    {
        $unsaveMsg = "Unsaved this post.";
        header("refresh:3;detail.php?pid=".$pid); // redirects page after 3 seconds.
    } 
}

if(isset($_POST['order']))
{
    $qty          = $_POST['qty'];
    $delivery     = $_POST['delivery'];
    $shop_id      = $_POST['shop_id'];
    $user_id      = $_POST['user_id'];
    $post_id      = $_POST['post_id'];

    $sql = $MySQLiconn->query("INSERT INTO onemart_tempo(user_id, user_phone, post_id, shop_id, qty, delivery, created_date, modified_date) VALUES('".$user_id."', '".$phone."', '".$post_id."', '".$shop_id."', '".$qty."', '".$delivery."', '".$today."', '".$today."' )"); 

    if($sql)
    {
        $cartMsg = "Inserted to Shopping Cart.";
        header("refresh:3;detail.php?pid=".$pid); // redirects page after 3 seconds.
    } 
}
    
if(isset($_POST['liked']))
{
    $post_id    = $_POST['postid'];

    $k          = $MySQLiconn->query("SELECT * FROM onemart_post where id = '$post_id' ");
    $mk         = $k->fetch_array();
    $n          = $mk['check_count'];
    $shop_id    = $mk['shop_id'];
        

    $MySQLiconn->query("INSERT INTO onemart_check(user_id, shop_id, post_id, created_date, modified_date) VALUES('".$id."', '".$shop_id."', '".$post_id."', now(), now())"); 

    $MySQLiconn->query("UPDATE onemart_post SET check_count = $n+1 WHERE id='$post_id'");
       
    echo $n+1;
    exit();
}

if(isset($_POST['unliked']))
{
        
    $post_id    = $_POST['postid'];
       
    $k          = $MySQLiconn->query("SELECT * FROM onemart_post where id = '$post_id' ");
    $mk         = $k->fetch_array();
    $n          = $mk['check_count'];
    $shop_id    = $mk['shop_id'];  

    $MySQLiconn->query("DELETE FROM onemart_check WHERE user_id = '$id' and post_id = '$post_id' ");
    $MySQLiconn->query("UPDATE onemart_post SET check_count = $n-1 WHERE id='$post_id'"); 

    echo $n-1;
    exit();

}
      
// shop like  
if(isset($_POST['shop_liked']))
{

    $shop_id    = $_POST['shopid'];
       
    $k          = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$shop_id' ");
    $mk         = $k->fetch_array();
    $n          = $mk['check_count'];
        
    $MySQLiconn->query("INSERT INTO onemart_shop_check(user_id, shop_id, created_date, modified_date) VALUES('".$id."', '".$shop_id."', now(), now())"); 

    $MySQLiconn->query("UPDATE onemart_acc SET check_count = $n+1 WHERE id='$shop_id'");
    
    echo $n+1;
    exit();

}


if(isset($_POST['shop_unliked']))
{
        
    $shop_id    = $_POST['shopid'];
    
    $k          = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$shop_id' ");
    $mk         = $k->fetch_array();
    $n          = $mk['check_count'];
       
    $MySQLiconn->query("DELETE FROM onemart_shop_check WHERE user_id = '$id' and shop_id = '$shop_id' ");
    $MySQLiconn->query("UPDATE onemart_acc SET check_count = $n-1 WHERE id='$shop_id'"); 

    echo $n-1;
    exit();
}
    
// end shop like
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
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous"> 
    
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">  

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
          background: #006698;
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

    <div class="fixed-top">
        <div class="row w3-card-4" style="background-color: #02b875; color: white; height: 60px; line-height: 60px; text-align: center; font-size: 19px;">
            <div class="col-2">
                <a href="#" onclick="goBack()" style="text-align: center;color: white;background-color: #02b875;">
                    <i class="fa fa-arrow-left"> </i>
                </a>
            </div>
            <div class="col-6">
                <pre class="text-justify zawgyi" style="word-wrap: break-word; width: 100%;color:white;overflow: hidden;"><?php echo $pp['name']; ?></pre>
            </div>
            <div class="col-2" style="">
                <a href="cart.php">
                    <?php
                        $cart = $MySQLiconn->query("SELECT * FROM onemart_tempo where user_id = '$id' and cart = '1' ");
                        $count = $cart->num_rows;
                    ?>
                    <span style="font-size: 22px;" class="fa-stack fa-x has-badge" data-count="<?php echo $count; ?>">
                        <i class="fa fa-shopping-cart fa-stack-x fa-inverse"></i>
                    </span>
                </a>
            </div>
            <div class="col-2">
                <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
                    <i class="material-icons">more_vert</i>
                </button>
                <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
                    <li class="mdl-menu__item">
                    <?php
                    $save_list = $MySQLiconn->query("SELECT id FROM onemart_save where user_id = '$id' and post_id = '$pid' ");
                    $save_count = $save_list->num_rows;

                    if ( $save_count == 1 ) {  ?>
                    
                        <a href="?unsave=<?php echo $pid; ?>&pid=<?php echo $pid; ?>" >
                            <i class="fa fa-bookmark"> </i> &nbsp; Unsaved 
                        </a>
                    
                    <?php } ?>
                    
                    <?php  if ( $save_count == 0 ) {  ?>
                    
                    <a href="?save=<?php echo $pid; ?>&pid=<?php echo $pid; ?>" >
                        <i class="fa fa-bookmark"> </i> &nbsp; Save 
                    </a>
                    
                    <?php } ?>

                </li>
            </ul>
        </div>
    </div>
    <!-- save -->
    <?php if (!empty($saveMsg)) { ?>
        <div class="alert alert-info" role="alert" style="color: #000;">
            <?php echo $saveMsg; ?> &nbsp;  
        </div>
    <?php } ?>
    <!-- end save -->

    <!-- unsave -->
    <?php if (!empty($unsaveMsg)) { ?>
        <div class="alert alert-danger" role="alert" style="color: #000;">
            <?php echo $unsaveMsg; ?> &nbsp;  
        </div>
    <?php } ?>
    <!-- end unsave -->

    <!-- cart -->
    <?php if (!empty($cartMsg)) { ?>
        <div class="alert alert-info" role="alert" style="color: #000;">
            <?php echo $cartMsg; ?> &nbsp;  
        </div>
    <?php } ?>
    <!-- end cart -->

</div>
  
<!-- modal -->
<div id="id01" class="w3-modal">
    <div class="w3-modal-content">
        <header class="w3-container" style="background-color: #02b875;"> 
            <span onclick="document.getElementById('id01').style.display='none'" 
            class="w3-closebtn" style="color: white;">×</span>
            <h2 class="zawgyi" style="color: white;text-align: center;">Quantity Form</h2>
        </header>
        <div class="w3-container">
            <h4 class="zawgyi" style="text-align: center; color: #02b875;">
                <?php echo $pp['name']; ?> 
            </h4>  
            <form class="form" enctype="multipart/form-data" role="form" action="" method="post" style="margin-top: 50px; margin-bottom: 50px;">  
                <div class="form-group">
                    <input type="number" name="qty" value="1" maxlength="4" class="form-control" required>
                </div> 
                <input type="hidden" name="delivery" value="<?php echo $pp['delivery']; ?>">
                <input type="hidden" name="shop_id" value="<?php echo $shop_id; ?>">
                <input type="hidden" name="post_id" value="<?php echo $pid; ?>">
                <input type="hidden" name="user_id" value="<?php echo $id; ?>">
            
                <button type="submit" name="order" class="btn btn-sm btn-block zawgyi" style="font-size: 15px; font-weight: bold;background-color: #02b875;color: white;">
                    Order &nbsp; <i class="fa fa-send"></i>
                </button> 
            </form>    
        </div>
    </div>
</div>
<!-- end modal -->


<!-- slider -->
<div id="carouselExampleIndicators" class="carousel slide col-md-4 offset-md-4" data-ride="carousel" style="margin-top: 40px;">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="post/<?php echo $pp['img1']; ?>">
                <img class="d-block w-100" src="post/<?php echo $pp['img1']; ?>" alt="First slide">
            </a>
        </div>

        <?php if(!empty($pp['img2'])) {?>
        <div class="carousel-item">
            <a href="post/<?php echo $pp['img2']; ?>">
                <img class="d-block w-100" src="post/<?php echo $pp['img2']; ?>" alt="Second slide">
            </a>
        </div>
        <?php } ?>

        <?php if(!empty($pp['img3'])) {?>
        <div class="carousel-item">
            <a href="post/<?php echo $pp['img3']; ?>">
                <img class="d-block w-100" src="post/<?php echo $pp['img3']; ?>" alt="third slide">
            </a>
        </div>
        <?php } ?>

        <?php if(!empty($pp['img4'])) {?>
        <div class="carousel-item">
            <a href="post/<?php echo $pp['img4']; ?>">
                <img class="d-block w-100" src="post/<?php echo $pp['img4']; ?>" alt="four slide">
            </a>
        </div>
        <?php } ?>

        <?php if(!empty($pp['img5'])) {?>
        <div class="carousel-item">
            <a href="post/<?php echo $pp['img5']; ?>">
                <img class="d-block w-100" src="post/<?php echo $pp['img5']; ?>" alt="five slide">
            </a>
        </div>
        <?php } ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- end slider -->

<!-- tab -->
<div class="demo-layout mdl-layout">
    <main class=" mdl-color--white-100">
        <div class="">
        <?php
            $comm = $MySQLiconn->query("SELECT * FROM onemart_comment where page_id = '$pid' order by created_date desc");
            $c_count = $comm->num_rows;

            $check = $MySQLiconn->query("SELECT * FROM onemart_check where post_id = '$pid' order by created_date desc");
            $ce_count = $check->num_rows;

            $vi = $MySQLiconn->query("SELECT * FROM onemart_view where post_id = '$pid' order by created_date desc");
            $vi_count = $vi->num_rows;
        ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-b-0">
                            <ul class="nav nav-tabs customtab" role="tablist">
          	                    <li class="nav-item col-3" style="text-align: center;"> 
                                    <a class="nav-link" data-toggle="tab" href="#info" role="tab">
                                        <span style="font-size: 18px;" class="fa-stack fa-x has-badge">
                    	                   <i class="fa fa-info-circle fa-stack-x fa-inverse" style="color: #000;"></i>
                                        </span>
                                    </a> 
                                </li>
                                <li class="nav-item col-3" style="text-align: center;"> 
                                    <a class="nav-link" data-toggle="tab" href="#comments" role="tab">
                                        <span style="font-size: 18px;" class="fa-stack fa-x has-badge" data-count="<?php echo $c_count; ?>">
                    	                   <i class="fa fa-comments fa-stack-x fa-inverse" style="color: #000;"></i>
                                        </span>
                                    </a> 
                                </li>
                                <li class="nav-item col-3" style="text-align: center;"> 
                                    <a class="nav-link" data-toggle="tab" href="#check" role="tab">
                                        <span style="font-size: 18px;" class="fa-stack fa-x has-badge" data-count="<?php echo $ce_count; ?>">
                    	                   <i class="fa fa-thumbs-up fa-stack-x fa-inverse" style="color: #000;"></i>
                                        </span>
                                    </a> 
                                </li>
                                <li class="nav-item col-3" style="text-align: center;"> 
                                    <a class="nav-link" data-toggle="tab" href="#view" role="tab">
                                        <span style="font-size: 18px;" class="fa-stack fa-x has-badge" data-count="<?php echo $vi_count; ?>">
                    	                   <i class="fa fa-eye fa-stack-x fa-inverse" style="color: #000;"></i>
                                        </span>
                                    </a> 
                                </li>
                            </ul>
                        <div class="tab-content">
                            <!-- information -->
                            <div class="tab-pane active" id="info" role="tabpanel">
                                <div class="container">
                                    <div class="row">
                                        <div class="container" style="margin-top: 15px;">
                        	                <p style="color: #888; font-weight:bold; font-size: 15px;text-align:left;">
                                                Product Name:
                                            </p>
                        	                <div class="row">
                        		                <div class="col-9">
                        			                <p class="text-justify zawgyi" style="text-align: left;color: #02b875;font-size:15px; font-weight:bold;">
                                                        <i class="fa fa-copy"></i>&nbsp;  
                                                        <?php echo $pp['name']; ?> 
                                                    </p>
                        		                </div>
                        		                <?php
                                                    $active = $MySQLiconn->query("SELECT id FROM onemart_check where user_id = '$id' and post_id = '$pid' ");
                                                    $active_count = $active->num_rows;

                                                    if ( $active_count == 1 ) {  
                                                ?>
                                
                                                <div class="col-3" style="color: #02b875;font-size: 18px;">
                        
                                                    <span class="unlike fa fa-thumbs-up" data-id="<?php echo $pid; ?>"></span> 
                                                    
                                                    <span class="like hide fa fa-thumbs-o-up" data-id="<?php echo $pid; ?>"></span>
                                                    
                                                    <span class="likes_count">&nbsp;.&nbsp;<?php echo $pp['check_count']; ?> </span> 
                                                </div>
                        
                                            <?php } else { ?>
                                                
                                                <div class="col-3" style="color: #02b875;font-size: 18px;">
                        
                                                    <span class="like fa fa-thumbs-o-up" data-id="<?php echo $pid; ?>"></span> 
                                                    
                                                    <span class="unlike hide fa fa-thumbs-up" data-id="<?php echo $pid; ?>"></span>
                                                    
                                                    <span class="likes_count">&nbsp;.&nbsp;<?php echo $pp['check_count']; ?> </span> 
                          
                                                </div>
                        
                                            <?php } ?>
                       
                        	               </div><hr/>
                                        </div>
                
                                        <div class="col-12" style="">
                                            
                                            <p style="color: #888; font-weight:bold; font-size: 15px;text-align:left;">Product Price:</p>
                                            
                                            <p class="text-justify zawgyi" style="text-align: left;color: #02b875;font-size:15px; font-weight:bold;">
                                                
                                                <i class="fa fa-money"> </i>  &nbsp;  
                                                <?php echo number_format($pp['price']); ?> KS
                                            </p>
                                            <span>
                                                <?php if(!empty($pp['strike'])){ ?>
                                                    <strike>
                                                        <i class="fa fa-money"> </i>  &nbsp;  
                                                        <?php echo number_format($pp['strike']); ?>
                                                    </strike> KS
                                                <?php } ?>
                                            </span><hr/>

                                        </div>
                      
                                        <div class="col-12" style="">
                                            
                                            <p style="color: #888; font-weight:bold; font-size: 15px;text-align:left;">
                                                Delivery Service:
                                            </p>
                                            
                                            <h6 class="text-justify zawgyi" style="text-align:left;color:#02b875;">
                                               
                                                <i class="fa fa-truck"> </i>  &nbsp; 
                                                <?php if($pp['delivery'] == 1){ ?>
                                                        OneMart 
                                                <?php } ?>

                                                <?php if($pp['delivery'] == 2){ ?>
                                                        Own Delivery
                                                <?php } ?>
                                            
                                            </h6><hr/>

                                        </div>
                      
                                        <div class="col-12" style="">
                                            
                                            <p style="color: #888; font-weight:bold; font-size: 15px;text-align:left;">
                                                Product Description:
                                            </p>
                                            
                                            <p class="text-justify zawgyi" style="text-align: left;color: #000;padding-bottom: 15px;font-size: 14px;color: #02b875;">
                                                    <i class="fa fa-pencil"> </i>  &nbsp; 
                                                    <?php echo $pp['description']; ?>            
                                            </p><hr/>
                                        
                                        </div>
                      
                                        <?php if($pp['taker'] == 1 ){ ?>
                                            <div class="col-12" style="">
                                                <p style="color: #888; font-weight:bold; font-size: 15px;text-align:left;">
                                                    Order Taker:
                                                </p>
                                                <p class="text-justify zawgyi" style="text-align: left;color: #000;padding-bottom: 15px;font-size: 15px;color: #006698;">
                                                        <i class="fa fa-star"> </i>  &nbsp; 
                                                        <?php echo $pp['name']; ?> &nbsp;ကိုမည္​သူမဆို order ​ေကာက္​ယူႏိုင္​ပါသည္​။ ပစၥည္​းႏ​ွင္​့သက္​ဆိုင္​သည္​့ ဓာတ္​ပံု ၊ အခ်က္​အလက္​မ် ားကို <?php echo $ss['shop_name'];?> မွ​ေပးပါမည္​။ order ​ေကာက္​ခ သိလိုလ်ွင္​ &nbsp; <a style="color: black;" href="tel:<?php echo $ss['phone'];?>"> <?php echo $ss['phone'];?> </a>
                                                </p><hr/>
                                            </div>
                                        <?php } ?>
                      
                                <!-- shop profile -->
                                <div class="container">
                                    <div class="card-body" style="">
                                        <p style="color: #888; font-weight:bold; font-size: 15px;text-align:left;">
                                            Shop Profile:
                                        </p>
                                        <div class="row">
                                            <div class="recent-meaasge">
                                                <div class="media">
                                                    <div class="col-4">
                                                        <div class="media-left">
                                                            <a href="my_wall.php?uid=<?php echo $ss['id']; ?>" style="text-decoration: none;">
                                          
                                                                <img alt="..." src="shop_profile/<?php echo $ss['shop_photo']; ?>" class="demo-avatar" style="width: 90px; height: 90px;">
                                                            </a>
                                          
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="my_wall.php?uid=<?php echo $ss['id']; ?>" style="text-decoration: none;">
                                                            <div class="media-body">
                                                                <p class="media-heading zawgyi" style="color:#02b875;font-weight: bold;font-size: 16px;margin-top: 10px;">
                                                                    <?php echo $ss['shop_name'];?>
                                                                </p>
                                        
                                                                <p style="color: #02b875;font-size:12px;font-weight: bold; text-align: left;">
                                                                    <i class="fa fa-circle" style="color: #00ff00;"> </i>
                                                                    <time class="timeago" datetime="<?php echo $ss['active']; ?>"></time>
                                                                </p>

                                                                <p style="color: #888;font-size:12px;text-align: left;font-weight: bold;">
                                                                    <?php echo $ss['check_count']; ?> people like this shop.
                                                                </p>
                                        
                                                                <p style="color: #888;font-size:12px;text-align: left;" class="zawgyi">
                                                                    <i class="fa fa-home"></i> <?php echo $ss['address']; ?>
                                                                </p>
                                                            
                                                            </div>
                                                        </a>
                                                    </div>
                                    
                                                    <?php
                                                        $active = $MySQLiconn->query("SELECT id FROM onemart_shop_check where user_id = '$id' and shop_id = '".$ss['id']."' ");
                                                        $active_count = $active->num_rows;

                                                        if ( $active_count == 1 ) {  
                                                    ?>
                                
                                                    <div class="col-2" style="color: #02b875;margin-top:31px;">
                        
                                                        <span style="font-size: 23px;" class="shop_unlike fa fa-thumbs-up" data-id="<?php echo $ss['id']; ?>"></span> 
                                  
                                                        <span style="font-size: 23px;" class="shop_like hide fa fa-thumbs-o-up" data-id="<?php echo $ss['id']; ?>"></span>
                                  
                                                        <span style="font-size: 15px;" class="shop_likes_count hidden">&nbsp;.&nbsp;<?php echo $ss['check_count']; ?> </span> 
                                                    </div>
                        
                                                <?php } else { ?>

                                                    <div class="col-2" style="color: #02b875;margin-top:31px;">
                        
                                                        <span style="font-size: 23px;" class="shop_like fa fa-thumbs-o-up" data-id="<?php echo $ss['id']; ?>"></span>
                                  
                                                        <span style="font-size: 23px;" class="shop_unlike hide fa fa-thumbs-up" data-id="<?php echo $ss['id']; ?>"></span>
                                  
                                                        <span style="font-size: 15px;" class="shop_likes_count hidden">&nbsp;.&nbsp;<?php echo $ss['check_count']; ?> </span> 
                                                    </div>
                        
                                                <?php } ?>
                                    
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end shop profile -->
                     
                            <!-- related products -->
                            <div class="container">
                                <div class="card-body" style="">
                                    <p style="color: #888; font-weight:bold; font-size: 22px;text-align:center;text-decoration: underline;margin-top: 20px;">
                                        Related Products
                                    </p>
                                    <div class="row">
                                    <?php
                                        $related = $MySQLiconn->query("SELECT * FROM onemart_post where category_id = '".$pp['category_id']."' and id != '".$pp['id']."' ORDER BY RAND() LIMIT 4 ");
                                        $relate_count = $related->num_rows;
                                        while($r=$related->fetch_array()) {
                                    ?>
                                        <div class="recent-meaasge">
                                            <div class="media">
                                                <div class="col-5">
                                                    <div class="media-left">
                                                        <a href="detail.php?pid=<?php echo $r['id']; ?>" style="text-decoration: none;">
                                                
                                                            <img alt="..." src="post/<?php echo $r['img1']; ?>" class="demo-avatar" style="width: 100px; height: 100px;">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <a href="detail.php?pid=<?php echo $r['id']; ?>" style="text-decoration: none;">
                                                        <div class="media-body">
                                                            
                                                            <p class="media-heading zawgyi" style="color:#02b875;font-weight:bold;font-size: 16px;margin-top:10px;">
                                                                <?php echo $r['name'];?>
                                                            </p>

                                                            <p style="color: #000;font-size:13px;text-align: left;font-weight: bold;">
                                                                <?php echo $r['price']; ?> Ks
                                                                <strike style="color:#006698;font-size:12px;"> 
                                                                    <?php echo $r['strike']; ?>Ks
                                                                </strike>
                                                            </p>
                                          
                                                            <p style="color: #000;font-size:12px;text-align:left;" class="zawgyi">
                                                                <i class="fa fa-pencil"></i> 
                                                                <?php echo substr($r['description'],0,70); ?>...
                                                            </p>
                                          
                                                            <p style="color: #888;font-size:12px;text-align: left;font-weight: bold;">
                                                                <?php echo $r['check_count']; ?> people like this product.
                                                            </p> 
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- end related products -->
                    </div>
                </div>
            </div>
            <!-- end information -->
            
            <!-- Comments -->
            <div class="tab-pane" id="comments" role="tabpanel">
                <div class="container" style="margin-top: 20px;">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 offset-md-3">   
                            <center>
                                <img src="profile/<?php echo $profile; ?>" class="img-circle avatar" alt="user profile image" style="width:80px; height:80px; line-height: 80px;">  
                            </center>
                            <p style="text-align: center;font-size: 20px; color: #02b875;padding-top: 15px;" class="zawgyi">  
                              <?php echo $name; ?>
                            </p>
                            <form class="form" enctype="multipart/form-data" role="form" action="" method="post">     
                                <div class="form-group">
                                    <textarea class="form-control zawgyi" rows="5" name="comment" placeholder="Type Your Feedbacks!..."></textarea>
                                </div> 
                                <input type="hidden" name="page_id" value="<?php echo $pid; ?>">
                                <button type="submit" name="btncomment" class="zawgyi btn btn-sm btn-block" style="font-size: 15px; font-weight: bold;background-color: #02b875;color: white;">
                                  Send &nbsp; <i class="fa fa-send"></i>
                                </button> 
                            </form>    
                        </div>
                    </div>
                </div><hr>
                
                <!-- comment list -->
                <div class="card-body" style="margin-bottom: 20px;">
                    <div class="recent-meaasge">
                    <?php
                        while($com  =$comm->fetch_array()) {

                        $uid = $com['user_id'];
                        $me = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$uid' LIMIT 1");
                        $men  = $me->fetch_array();
                    ?>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img alt="..." src="profile/<?php echo $men['profile']; ?>" class="demo-avatar">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading zawgyi">
                                    <?php echo $men['username'];?>
                                </h4>
                          
                                <p class="f-s-13 zawgyi text-justify" style="color:black; font-size: 12px;">
                                    <?php echo $com['comment']; ?> 
                                </p>
                                
                                <p  style="font-size: 11px; color: #888;font-weight: bold;">
                                    <time class="timeago" datetime="<?php echo $com['created_date']; ?>"></time>
                                </p>
                        </div>
                    </div>
                    <?php } ?> 
                </div>
            </div>
            <!-- end comment list -->
        </div>
        <!-- end Comments -->

        <!-- Check -->
        <div class="tab-pane" id="check" role="tabpanel">
            <div class="card-body" style="margin-bottom: 20px;">
                <div class="recent-meaasge">
                    <?php
                        while($ck  =$check->fetch_array()) {

                        $uid = $ck['user_id'];
                        $uuu = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$uid' LIMIT 1");
                        $uu  =$uuu->fetch_array();
                    ?>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img alt="..." src="profile/<?php echo $uu['profile']; ?>" class="demo-avatar">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading zawgyi">
                                <?php echo $uu['username']; ?> &nbsp; &nbsp;
                                <i style="text-align:right; color: #02b875;" class="fa fa-thumbs-up"></i>
                            </h4>
                        </div>    
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div> 
        <!-- end check -->

        <!-- view -->
        <div class="tab-pane" id="view" role="tabpanel">
            <div class="card-body" style="margin-bottom: 20px;">
                <div class="recent-meaasge">
                    <?php
                      
                        while($vvi  =$vi->fetch_array()) {

                        $uid = $vvi['user_id'];
                        $vvv = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$uid' LIMIT 1");
                        $vv  =$vvv->fetch_array();
                    ?>
                    
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img alt="..." src="profile/<?php echo $vv['profile']; ?>" class="demo-avatar">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading zawgyi">
                                <?php echo $vv['username']; ?> &nbsp; &nbsp;
                                <i style="text-align:right; color: #02b875;" class="fa fa-eye"></i>
                            </h4>
                        </div> 
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div> 
        <!-- end view -->
        
        </div>
      </div>
    </div>
  </div>
</div>

        </div>
    </main>
</div>         
<!-- end tab -->



<div class="fixed-bottom">
    <div class="row w3-card-4" style="height: 40px; line-height: 40px; text-align: center; font-size: 17px; border: 1px solid #02b875;">    
      
        <div class="col-9">
            <a style="background-color: #02b875; color: white;margin-top: 2px;height: 35px; font-size: 17px;" href="#" class="btn btn-sm btn-block zawgyi text-justify text-center" onclick="document.getElementById('id01').style.display='block'">
              <i class="fa fa-shopping-cart"></i>&nbsp;ေစ်းျခင္​း​ေတာင္​းထဲ ထည္​့မယ္​။
            </a>
        </div> 

        <div class="col-3">
            <a href="#" id="connect" style="background-color: #02b875; color: white;margin-top: 2px;height: 35px; font-size: 17px;text-decoration: none;" class="btn btn-sm btn-block zawgyi text-justify text-center">
                <i style="font-size: 20px;" class="fa fa-phone"></i>
            </a>
            <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--top-right" for="connect">
            
                <a style="text-decoration: none;" href="tel:<?php echo $ss['phone']; ?>"> 
                    <li class="mdl-menu__item" style="background-color: #2c5da3; color: white;">   &nbsp; 
                        <i class="fa fa-phone"> </i> Phone
                    </li>
                </a>
            
                <a style="text-decoration: none;" href="sms:<?php echo $ss['phone']; ?>?body= <?php echo $pp['name']; ?>">
                    <li class="mdl-menu__item" style="background-color: #009968; color: white;">&nbsp; 
                        <i class="fa fa-comment-alt"> </i> Message 
                    </li>
                </a>
            
                <a style="text-decoration: none;" href="viber://chat?number=<?php echo $ss['phone']; ?>">
                    <li class="mdl-menu__item" style="background-color: #59267c; color: white;">   &nbsp; 
                        <i class="fa fa-phone-volume"> </i> Viber 
                    </li>
                </a>
           
                <a style="text-decoration: none;" href="<?php echo $ss['messenger']; ?>">
                  <li class="mdl-menu__item" style="background-color: #0084FF; color: white;">   &nbsp; 
                      <i class="fa fa-comments"> </i> Messenger
                  </li>
                </a>
            </ul>

        </div>
    </div>
</div>


<script>
    function goBack() {
    window.history.back();
    }
</script>

<!-- post like & unlike -->
<!-- Add Jquery to page -->
<script src="jquery-1.8.0.min.js"></script>
<script>
  $(document).ready(function(){
    // when the user clicks on like
    $('.like').on('click', function(){
      var postid = $(this).data('id');
      
      
          $post = $(this);

      $.ajax({
        url: 'detail.php?pid=<?php echo $pid; ?>',
        type: 'post',
        data: {
          'liked': 1,
          'postid': postid
          
        },
        success: function(response){
          $post.parent().find('span.likes_count').text(response + "");
          $post.addClass('hide');
          $post.siblings().removeClass('hide');
        }
      });
    });
    

    // when the user clicks on unlike
    $('.unlike').on('click', function(){
      var postid = $(this).data('id');
        $post = $(this);

      $.ajax({
        url: 'detail.php?pid=<?php echo $pid; ?>',
        type: 'post',
        data: {
          'unliked': 1,
          'postid': postid
        },
        success: function(response){
          $post.parent().find('span.likes_count').text(response + "");
          $post.addClass('hide');
          $post.siblings().removeClass('hide');
        }
      });
    });
  });
</script>
<!-- end post like & unlike -->

<!-- shop like & unlike -->
<script>
  $(document).ready(function(){
    // when the user clicks on like
    $('.shop_like').on('click', function(){
      var shopid = $(this).data('id');
      
      
          $post = $(this);

      $.ajax({
        url: 'detail.php?pid=<?php echo $pid; ?>',
        type: 'post',
        data: {
          'shop_liked': 1,
          'shopid': shopid
          
        },
        success: function(response){
          $post.parent().find('span.shop_likes_count').text(response + "");
          $post.addClass('hide');
          $post.siblings().removeClass('hide');
        }
      });
    });
    

    // when the user clicks on unlike
    $('.shop_unlike').on('click', function(){
      var shopid = $(this).data('id');
        $post = $(this);

      $.ajax({
        url: 'detail.php?pid=<?php echo $pid; ?>',
        type: 'post',
        data: {
          'shop_unliked': 1,
          'shopid': shopid
        },
        success: function(response){
          $post.parent().find('span.shop_likes_count').text(response + "");
          $post.addClass('hide');
          $post.siblings().removeClass('hide');
        }
      });
    });
  });
</script>
<!-- end shop like & unlike -->


    <!-- time ago js -->
    <script src="js/timeago.js"></script>
    <!-- end time ago js -->

     <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
     
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
  </body>
</html>
