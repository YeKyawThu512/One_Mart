<?php
include("header.php");

if(empty($_GET['uid']))
{
    echo "<script>window.open('index.php','_self')</script>";
}
else
{
    $uid  = $_GET['uid'];
    $result = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$uid' LIMIT 1");
    $row=$result->fetch_array();
}

if(!empty($_GET['del_id']))
{
    $id = $_GET['del_id'];
    $MySQLiconn->query("DELETE FROM onemart_post WHERE id = '$id' ");
    header("Location: index.php");
}

if(!empty($_GET['cat']))
{
    $cat = $_GET['cat'];
    $post = $MySQLiconn->query("SELECT * FROM onemart_post where category_id = '$cat' order by created_date desc");
}
elseif(!empty($_GET['kk']))
{
    $kk = htmlspecialchars($_GET['kk']);
    $post = $MySQLiconn->query("SELECT * FROM onemart_post where name  LIKE '%$kk%' or price  LIKE '%$kk%' or strike  LIKE '%$kk%' or description  LIKE '%$kk%' order by created_date desc");
    $ser_count = $post->num_rows;
}
else
{
    $post = $MySQLiconn->query("SELECT * FROM onemart_post where shop_id = '$uid' order by created_date desc");

    $post_count = $post->num_rows;     
}

if(!empty($_GET['like_add']))
{
  
    $shop_id = $_GET['like_add'];

    $k = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$shop_id' ");
    $mk=$k->fetch_array();
    $n = $mk['check_count'];    

    $MySQLiconn->query("INSERT INTO onemart_shop_check(user_id, shop_id, created_date, modified_date) VALUES('".$id."', '".$shop_id."', now(), now())"); 

    $MySQLiconn->query("UPDATE onemart_acc SET check_count = $n+1 WHERE id='$shop_id'"); 
    
    ?>
      
        <script>   
            window.location.href='my_wall.php?uid=<?php echo $shop_id; ?>';
        </script>
     
    <?php
}

if(!empty($_GET['like_del']))
{
        
    $shop_id = $_GET['like_del'];

    $k = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$shop_id' ");
    $mk=$k->fetch_array();
    $n = $mk['check_count'];
      
    $MySQLiconn->query("DELETE FROM onemart_shop_check WHERE user_id = '$id' and shop_id = '$shop_id'");
    $MySQLiconn->query("UPDATE onemart_acc SET check_count = $n-1 WHERE id='$shop_id'"); 

?>
        <script>   
            window.location.href='my_wall.php?uid=<?php echo $shop_id; ?>';
        </script>

    <?php
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
    <link rel="stylesheet" href="css/w3.css">
    <link rel="shortcut icon" href="logo/My Drawing (JPG).jpg">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

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

        #view-source {
            position: fixed;
            right: 0;
            bottom: 0;
            margin-right: 35px;
            margin-bottom: 35px;
            z-index: 900;
            color: #02b875;
            height: 60px;
            width: 60px;
            background-color: #02b875;
            border-radius: 50%;
            display: inline-block;
            text-align: center;
        } 

        .hide {
            display: none;
        }

        .like, .unlike {
            font-size: 20px;
            margin-top: 1px;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
            margin-left: 15px;
        }

        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            font-size: 24px;
            line-height: 1.33;
            border-radius: 35px;
        }

        div.scrollmenu {
            background-color: #fff;
            overflow-x: auto;
            white-space: nowrap;
            width: 100%;
        }

    </style>
  </head>
  <body>

    <div class="fixed-top">
        <div class="row w3-card-4" style="background-color: #02b875; color: white; height: 60px; line-height: 60px; text-align: center; font-size: 19px;">
            <div class="col-2">
                <a href="index.php" style="text-align: center;color:white;">
                    <i class="fa fa-arrow-left"> </i>
                </a>
            </div>
            <div class="col-7">
                <pre class="text-justify zawgyi" style="word-wrap: break-word; width: 100%;color:white;overflow: hidden;text-align: left;">
                    <?php echo $row['shop_name']; ?> 
                </pre>
            </div>
            <div class="col-3">
                <?php
                    $sid = $row['id']; 
                    if($sid == $id)
                    {
                ?>
                <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
                    <i class="material-icons">more_vert</i>
                </button>
                <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
                    <li class="mdl-menu__item">
                        <a href="shop_edit.php" style="text-decoration:none;">
                            <i class="fa fa-edit"> </i> &nbsp; Edit Shop 
                        </a>
                    </li>
                </ul>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
  
    <div class="demo-layout mdl-layout mdl-js-layout">
        <main class=" mdl-color--white-100">
            <div class="">
                <div class="" style="margin-top: 100px;">
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <img class="demo-avatar" src="shop_profile/<?php echo $row['shop_photo']; ?>" alt="Card image cap" style="width: 250px; height: 250px;">
                            </center>
                         </div>
                    </div>   
                </div><hr>
                <center>
                    <div class="scrollmenu">
                    <?php 
                        $act = $MySQLiconn->query("SELECT id FROM onemart_shop_check where user_id = '$id' and shop_id = '$uid' ");
                        $act_count = $act->num_rows;

                        if ( $act_count == 1 ) {  
                    ?>
                        <a href="my_wall.php?like_del=<?php echo $uid; ?>&uid=<?php echo $uid; ?>" class="btn btn-circle btn-xl" style="border: 5px solid #02b875;color: #02b875;"> 
                            <i class="fa fa-thumbs-up" style="margin-top: 10px;"></i>
                        </a>

                    <?php } else { ?>

                        <a href="my_wall.php?like_add=<?php echo $uid; ?>&uid=<?php echo $uid; ?>" class="btn btn-circle btn-xl" style="border: 5px solid #02b875;color: #02b875;"> 
                            <i class="fa fa-thumbs-o-up" style="margin-top: 10px;"></i>
                        </a>

                    <?php } ?>

                        <a href="tel:<?php echo $row['phone']; ?>" class="btn btn-circle btn-xl" style="border: 5px solid #2c5da3;color: #2c5da3;">
                            <i class="fa fa-phone" style="margin-top: 10px;"></i>
                        </a>

                        <a href="sms:<?php echo $row['phone']; ?>?body= <?php echo $row['shop_name']; ?>" class="btn btn-circle btn-xl" style="border: 5px solid #009968;color: #009968;">
                            <i class="fa fa-comments" style="margin-top: 10px;"></i>
                        </a>

                        <a href="<?php echo $row['facebook']; ?>" class="btn btn-circle btn-xl" style="border: 5px solid #4267b2;color: #4267b2;">
                            <i class="fa fa-facebook" style="margin-top: 10px;"></i>
                        </a>

                        <a href="viber://chat?number=<?php echo $row['viber']; ?>" class="btn btn-circle btn-xl" style="border: 5px solid #59267c;color: #59267c;">
                            <i class="fa fa-phone" style="margin-top: 10px;"></i>
                        </a>

                        <a href="<?php echo $row['messenger']; ?>" class="btn btn-circle btn-xl" style="border: 5px solid #0084FF;color: #0084FF;">
                            <i class="fa fa-comment" style="margin-top: 10px;"></i>
                        </a><hr>
                    </div>
                </center>

                <center>
                    <a onclick="document.getElementById('id01').style.display='block'" href="#" style="color: #02b875;font-size: 16px;margin-top: 20px;"> 
                        <?php echo number_format($row['check_count']); ?> people like <?php echo $row['shop_name']; ?>.
                    </a><hr>
                </center>

                <!-- modal -->
                <div id="id01" class="w3-modal" style="overflow-y: auto;">
                    <div class="w3-modal-content">
                        <header class="w3-container" style="background: #02b875;color: white;"> 
                            <span onclick="document.getElementById('id01').style.display='none'" 
                            class="w3-closebtn">×</span>
                            <h4 style="text-align: center;">
                                <?php echo number_format($row['check_count']); ?> people like <?php echo $row['shop_name']; ?>. 
                            </h4>
                        </header>
                        <div class="w3-container">
                        <?php
                            $chk = $MySQLiconn->query("SELECT * FROM onemart_shop_check where shop_id = '$uid' ");
                            while($ck=$chk->fetch_array()){
                            $user_info = $ck['user_id'];

                            $usu = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$user_info' ");
                            $uus=$usu->fetch_array();
                        ?>
      
                        <div class="media" style="padding-top: 15px; padding-bottom: 15px;">
                            <div class="media-left">
                                <a href="#">
                                    <img alt="..." src="profile/<?php echo $uus['profile']; ?>" class="demo-avatar">
                                </a>
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading zawgyi">
                                    <?php echo $uus['username']; ?> &nbsp; &nbsp;
                                    <i style="text-align:right; color: #02b875;" class="fa fa-thumbs-up"></i>
                                </h5>
                            </div>
                        </div>
      
                    <?php } ?>
                    
                    </div>
                </div>
            </div>

            <!-- end modal -->

            <center>
                <div class="row">
                    <div class="col-12">
                        <p style="font-size: 15px;text-align: center;color: #02b875;"> 
                            <i class="fa fa-home"> </i> &nbsp;  <?php echo $row['address']; ?> 
                        </p>
                    </div>
                </div><hr>
            </center>

            <center>
                <div class="row">
                    <div class="col-6">
                        <p style="font-size: 15px;font-weight:bold;text-align: center;color: #02b875;"> 
                            <i class="fa fa-circle" style="color: #00ff00;"> </i>
                            <time class="timeago" datetime="<?php echo $row['active']; ?>"></time>
                        </p>
                    </div>
                    <div class="col-6">
                        <p style="font-size: 15px;text-align: center;color: #02b875;"> 
                            <?php echo number_format($post_count); ?> posts 
                        </p>
                    </div>
                </div><hr>
            </center><br/><br/>   
            
            <!--- card content -->
            <div class="container-fluid">
                <!--  category name -->
                <?php  
                if(isset($_GET['cat']))
                {
                    $cat = $_GET['cat'];
                    $cate = $MySQLiconn->query("SELECT * FROM onemart_category where id = '$cat' ");
                    $catt=$cate->fetch_array();
                ?>
                    <h4 style="text-align: center;color: #02b875;font-weight: bold;text-decoration: underline;" class="zawgyi"> 
                        <?php echo $catt['category']; ?> 
                    </h4>
                
                <?php
                } 
                ?>
                <!-- end category name -->

                <!--  search name -->
                <?php  if(!empty($kk))
                {     
                ?>
                    <h3 style="text-align: center;color: #02b875;font-weight: bold;font-style: italic;text-decoration: none;" class="zawgyi">  
                        <?php echo $kk; ?> <span class="badge" style="background-color: #02b875;color: white;"><?php echo $ser_count; ?></span>    
                    </h3>
                <?php
                } 
                ?>
                <!-- end search name -->


                <div class="">
                    <div class="row" style="">

                    <?php  
                    while($col=$post->fetch_array()) 
                    { 

                        $sid      = $col['shop_id'];
                        $page_id  = $col['id'];

                        $acc = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$sid' ");
                        $cc  = $acc->fetch_array();

                        if(isset($_POST['liked']))
                        {

                            $post_id      = $_POST['postid'];

                            $k = $MySQLiconn->query("SELECT * FROM onemart_post where id = '$post_id' ");
                            $mk=$k->fetch_array();
                            $n = $mk['check_count'];
        

                           $MySQLiconn->query("INSERT INTO onemart_check(user_id, shop_id, post_id, created_date, modified_date) VALUES('".$id."', '".$sid."', '".$post_id."', now(), now())"); 

                           $MySQLiconn->query("UPDATE onemart_post SET check_count = $n+1 WHERE id='$post_id'"); 

                            echo $n+1;
                            exit();
                        }


                        if(isset($_POST['unliked']))
                        {
        
                            $post_id      = $_POST['postid'];

                            $k = $MySQLiconn->query("SELECT * FROM onemart_post where id = '$post_id' ");
                            $mk=$k->fetch_array();
                            $n = $mk['check_count'];
      
                            $MySQLiconn->query("DELETE FROM onemart_check WHERE user_id = '$id' and shop_id = '$sid' and post_id = '$post_id' ");
                            $MySQLiconn->query("UPDATE onemart_post SET check_count = $n-1 WHERE id='$post_id'"); 
                              
                            echo $n-1;
                            exit();
                        }
                    ?>
    
                <!-- card -->   
                <div class="col-xs-12 col-md-4" style="margin-top: 10px;">
                    <div class="card w3-card-24" style="border: 1px solid #02b875;">
                        <div class="card-header" style="background-color:#fff;">
                            <div class="row">
                                <div class="col-2">
                                    <img class="demo-avatar" src="shop_profile/<?php echo $cc['shop_photo']; ?>" alt="Card image cap" style="width: 40px; height: 40px;">
                                </div>
                                <div class="col-8">
                                    <a href="my_wall.php?uid=<?php echo $cc['id']; ?>" style="font-weight: bold;color: #02b875;text-decoration: none;" class="zawgyi">     <?php echo $cc['shop_name']; ?> 
                                    </a>
                                    <div style="color: #888; font-size: 11px;text-transform: lowercase"> 
                                        @onemart &nbsp;&nbsp; 
                    
                                        <?php if($col['taker'] == 1 ){ ?>
                    
                                        <i style="color:red;" class="fa fa-star" title="Allow Order Taking"></i>
                    
                                        <?php } ?>
                                    </div>
                                </div>

                                <?php
                                    if(!empty($id))
                                    {
                                        if( $id == $sid ) 
                                        { 
                                ?>
        
                                <div class="col-2">
                                    <a href="#" class="" id="save<?php echo $col['id']; ?>">
                                        <i style="color: #02b875;text-align: right;" class="fa fa-caret-down"> </i>
                                    </a>
                                    <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="save<?php echo $col['id']; ?>">
                                        <li class="mdl-menu__item"> 
                                            <i class="fa fa-remove"> </i> 
                                            <a style="text-decoration: none;" href="index.php?del_id=<?php echo $col['id']; ?>"> Delete </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php 
                                }
                            }else{ 
                            ?>

                                <div class="col-2">
                                    <a href="#" class="" id="login<?php echo $col['id']; ?>">
                                        <i style="color: #02b875;text-align: right;" class="fa fa-caret-down"> </i>
                                    </a>
                                    <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="login<?php echo $col['id']; ?>">
                                        <a style="text-decoration: none;" href="logout.php">
                                            <li class="mdl-menu__item"> 
                                                <i class="fa fa-bookmark"> </i> 
                                                Save 
                                            </li>
                                        </a>
                                        <a style="text-decoration: none;" href="home.php?login=error">
                                            <li class="mdl-menu__item">
                                                    <i class="fa fa-remove"></i> 
                                                    Delete 
                                            </li>
                                        </a>
                                    </ul>
                                </div>
                            <?php } ?>
                            </div>
                        </div>

                        <a style="text-decoration: none;" href="detail.php?pid=<?php echo $col['id']; ?>">        
                        <?php
            
                            $img1 = $col['img1'];
                            $img2 = $col['img2'];
                            $img3 = $col['img3'];
                            $img4 = $col['img4'];
                            $img5 = $col['img5'];
                            $rand = (mt_rand(1,5));

                        ?>
                        <?php 	
                            if($rand == 1){
	                    ?>
	                       <img class="card-img-top img-fluid img-responsive" src="post/<?php echo $img1; ?>" alt="post image" style="height:350px;">  
	                    <?php
                            }elseif ($rand == 2) {
	                    ?>
	                       <img class="card-img-top img-fluid img-responsive" 
	                           src="post/<?php if(!empty($img2)) { echo $img2; }else { echo $img1; }  ?>" alt="post image" style="height:350px;">  
	                    <?php	
                            }elseif ($rand == 3) {
	                    ?>
	                        <img class="card-img-top img-fluid img-responsive" 
	                           src="post/<?php if(!empty($img3)) { echo $img3; }else { echo $img1; }  ?>" alt="post image" style="height:350px;">  
	                    <?php	
                            }elseif ($rand == 4) {
	                    ?>
	                        <img class="card-img-top img-fluid img-responsive" src="post/<?php if(!empty($img4)) { echo $img4; }else { echo $img1; }  ?>" alt="post image" style="height:350px;">  
	                    <?php	
                            }else {
	                    ?>
	                       <img class="card-img-top img-fluid img-responsive" src="post/<?php if(!empty($img5)) { echo $img5; }else { echo $img1; }  ?>" alt="post image" style="height:350px;">  
	                    <?php	
                            }
                        ?>
        
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <span class="card-title zawgyi" style="font-size: 17px;color: #09568d;"> 
                                    <?php echo $col['name']; ?> 
                                </span>
                                <div class="card-text" style="color: #02b875; font-size: 14px;font-weight: bold;"> 
                                    <?php echo number_format($col['price']); ?> KS
                                    <span style="color: black; font-size: 12px;">( <strike> <?php echo number_format($col['strike']); ?>  KS </strike> )</span> 
                                </div>
                            </div>

                            <?php 
                                $pppid = $col['id'];

                                $view = $MySQLiconn->query("SELECT id FROM onemart_view where post_id = '$pppid' ");
                                $view_count = $view->num_rows;
                            ?>

                            <div class="col-3">
                                <span style="font-size: 14px;"> 
                                    <i style="color: #02b875;font-weight: bold;margin-top: 15px;"  class="fa fa-eye"> </i>.<?php echo $view_count; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                
                <!-- footer count -->
                
                <?php 

                $cart_check = $MySQLiconn->query("SELECT id FROM onemart_check where post_id = '$pppid' ");
                $shop_count = $cart_check->num_rows;

                $comment_count = $MySQLiconn->query("SELECT * FROM onemart_comment where page_id = '$page_id' ");
                $com_count = $comment_count->num_rows;

                ?>

                <!-- end footer count -->

                <?php if(!empty($id)){ ?>
                    <div class="card-footer" style="background-color: #fff;">
                        <div class="row">

                        <?php
                            $active = $MySQLiconn->query("SELECT id FROM onemart_check where user_id = '$id' and post_id = '$pppid' ");
                            $active_count = $active->num_rows;

                            if ( $active_count == 1 ) {  
                        ?>
        
                            <div class="col-4" style="text-align: center;color: #02B875;">

                                <span class="unlike fa fa-thumbs-up" data-id="<?php echo $col['id']; ?>"></span> 
                                <span class="like hide fa fa-thumbs-o-up" data-id="<?php echo $col['id']; ?>"></span>
                                <span class="hidden" data-id="<?php echo $sid; ?>"></span>
                              
                                <span class="likes_count">&nbsp;.&nbsp;<?php echo $col['check_count']; ?> </span> 
                            </div>

                        <?php } else {?>

                            <div class="col-4" style="text-align: center;color: #02b875;">

                                <span class="like fa fa-thumbs-o-up" data-id="<?php echo $col['id']; ?>"></span> 
                                <span class="unlike hide fa fa-thumbs-up" data-id="<?php echo $col['id']; ?>"></span>
                                <span class="hidden" data-id="<?php echo $sid; ?>"></span>
          
                                <span class="likes_count">&nbsp;.&nbsp;<?php echo $col['check_count']; ?> </span> 
             
                            </div>

                        <?php } ?>
        
  
                            <div class="col-4" style="text-align: center;color: #02b875;">
                                <a href="detail.php?pid=<?php echo $page_id; ?>" style="text-decoration: none;color: #02B875;">
                                    <i class="fa fa-comment"> </i> &nbsp;<?php echo $com_count; ?>
                                </a>
                            </div>

                            <div class="col-4" style="text-align: center;color: #02b875;">
                                <a href="#" id="share<?php echo $col['id']; ?>" style="text-decoration: none;">
                                    <i style="color: #02b875;text-align: right;" class="fa fa-share-alt"> </i> &nbsp; 
                                </a>
                                <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--top-right" for="share<?php echo $col['id']; ?>">
                                    <li class="mdl-menu__item">   &nbsp; 
                                        <a style="text-decoration: none;" href="https://www.facebook.com/sharer/sharer.php?u=http://member20-witaward.webstarterz.com/one%20mart/detail.php?pid=<?php echo $col['id']; ?>"> Facebook </a>
                                    </li>
                                    <li class="mdl-menu__item">   &nbsp; 
                                        <a style="text-decoration: none;" href="fb-messenger://share/?link=http://member20-witaward.webstarterz.com/one mart/detail.php?pid=<?php echo $col['id']; ?>"> Messenger </a>
                                    </li>
                                    <li class="mdl-menu__item">   &nbsp;
                                        <a style="text-decoration: none;" href="viber://forward?text=http://member20-witaward.webstarterz.com/one%20mart/detail.php?pid=<?php echo $col['id']; ?>"> Viber </a>
                                    </li>
                                    <li class="mdl-menu__item">   &nbsp; 
                                        <a style="text-decoration: none;" href="mailto:?subject=OneMart.com.mm&body=<?php echo $col['name']; ?> : Price(<?php echo $col['price']; ?>) : http://member20-witaward.webstarterz.com/one%20mart/detail.php?pid=<?php echo $col['id']; ?>"> Mail </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>

                    <div class="card-footer" style="background-color: #fff;">
                        <div class="row">
                            <div class="col-4" style="text-align: center;color: #888;">
                                <a style="text-decoration: none;" href="home.php">
                                    <i style="font-size: 18px;" class="fa fa-check"> </i> &nbsp; <?php echo $shop_count; ?>
                                </a>
                            </div>

                            <div class="col-4" style="text-align: center;color: #02b875;">
                                <a href="detail.php?pid=<?php echo $page_id; ?>" style="text-decoration: none;">
                                    <i class="fa fa-comment"> </i> &nbsp; <?php echo $com_count; ?>
                                </a>
                            </div>

                            <div class="col-4" style="text-align: center;color: #02b875;">
                                <a href="#" id="share<?php echo $col['id']; ?>" style="text-decoration: none;">
                                    <i style="color: #02b875;text-align: right;" class="fa fa-share-alt"> </i> &nbsp; 
                                </a>
                                <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--top-right" for="share<?php echo $col['id']; ?>">
                                    <li class="mdl-menu__item">   &nbsp; 
                                        <a style="text-decoration: none;" href="https://www.facebook.com/sharer/sharer.php?u=http://member20-witaward.webstarterz.com/one%20mart/detail.php?pid=<?php echo $col['id']; ?>"> Facebook </a>
                                    </li>
                                    <li class="mdl-menu__item">   &nbsp; 
                                        <a style="text-decoration: none;" href="fb-messenger://share/?link=http://member20-witaward.webstarterz.com/one mart/detail.php?pid=<?php echo $col['id']; ?>"> Messenger </a>
                                    </li>
                                    <li class="mdl-menu__item">   &nbsp;
                                        <a style="text-decoration: none;" href="viber://forward?text=http://member20-witaward.webstarterz.com/one%20mart/detail.php?pid=<?php echo $col['id']; ?>"> Viber </a>
                                    </li>
                                    <li class="mdl-menu__item">   &nbsp; 
                                        <a style="text-decoration: none;" href="mailto:?subject=OneMart.com.mm&body=<?php echo $col['name']; ?> : Price(<?php echo $col['price']; ?>) : http://member20-witaward.webstarterz.com/one%20mart/detail.php?pid=<?php echo $col['id']; ?>"> Mail </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>    
                <?php } ?>
            </div>
        </div>   
        <!-- end list card -->
<?php } ?>

</div>
</div>
</div><br><br>

<!-- end card content --> 

</div> 
</main>
</div>
          
<!-- floating shopping cart -->
<?php
    if(!empty($id))
    {
        $cart=$MySQLiconn->query("SELECT id FROM onemart_tempo where user_id = '$id' and cart = '1' ");
        $count = $cart->num_rows;
        if($count > 0)
        {
?>

<a href="cart.php" target="" id="view-source" class="" style="font-size: 18px; text-decoration: none;">
    <span class="dot">
        <i class="fa fa-shopping-cart" style="color: white;margin-top: 20px;"></i>
        <sup style="color: white; font-size: 14px;"><?php echo $count; ?></sup>   
   </span> 
</a>

<?php } 
} else { ?>

<a href="cart.php" target="" id="view-source" class="" style="font-size: 18px; text-decoration: none;">
    <span class="dot">
        <i class="fa fa-shopping-cart" style="color: white;margin-top: 20px;"></i>
        <sup style="color: white; font-size: 14px;">0</sup>   
   </span>
</a>

<?php } ?>

<!-- end floating shopping cart -->


<!-- time ago js -->
<script src="js/timeago.js"></script>
<!-- end time ago js -->

  <!-- Add Jquery to page -->
<script src="jquery-1.8.0.min.js"></script>
<script>
  $(document).ready(function(){
    // when the user clicks on like
    $('.like').on('click', function(){
      var postid = $(this).data('id');
          $post = $(this);

      $.ajax({
        url: 'index.php',
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
        url: 'index.php',
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
  
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS --> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
