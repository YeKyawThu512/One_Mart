<?php
include("header.php");

if(isset($_POST['liked']))
{
    $post_id      = $_POST['postid'];

    $k = $MySQLiconn->query("SELECT * FROM onemart_post where id = '$post_id' ");
    $mk=$k->fetch_array();
    $n = $mk['check_count'];
    $shop_id = $mk['shop_id'];
        
    $MySQLiconn->query("INSERT INTO onemart_check(user_id, shop_id, post_id, created_date, modified_date) VALUES('".$id."', '".$shop_id."', '".$post_id."', now(), now())"); 

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
    $shop_id = $mk['shop_id'];
      

    $MySQLiconn->query("DELETE FROM onemart_check WHERE user_id = '$id' and post_id = '$post_id' ");
    $MySQLiconn->query("UPDATE onemart_post SET check_count = $n-1 WHERE id='$post_id'"); 

    echo $n-1;
    exit();
}

if(isset($_GET['uid']))
{
    $uid = $_GET['uid'];
    $post_id = $_GET['post_id'];

    $MySQLiconn->query("DELETE FROM onemart_save WHERE user_id = '$uid' and post_id = '$post_id' ");
          
    echo "<script>window.open('save_post.php','_self')</script>";
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/w3.css">
    <link rel="shortcut icon" href="logo/My Drawing (JPG).jpg">
    
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

        .zawgyi{
          font-family:Zawgyi-One;
        }
        .unicode{
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

    </style>
  </head>
  <body>

    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <header class="demo-header mdl-layout__header" style="background-color: #02b875; color: white;">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title">OneMart</span>
                <div class="mdl-layout-spacer"></div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                        <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                          <i class="material-icons">search</i>
                        </label>
                        <div class="mdl-textfield__expandable-holder">
                            <form name="search" action="index.php" method="post" >   
                                <input name="kk" class="mdl-textfield__input zawgyi" type="text" id="search" value="<?php  if(!empty($kk)){ echo $kk; }?>">
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
            <!--  <div class="mdl-grid demo-content"> -->
            <div class="">
                <!--- card content -->
                <div class="container-fluid">
                    <div>
                        <div class="row">

                <?php 

                $save = $MySQLiconn->query("SELECT * FROM onemart_save where user_id = '$id' order by created_date desc");

                while($sav=$save->fetch_array()) 
                { 

                    $post_id = $sav['post_id'];
                    $shop_id = $sav['shop_id'];

                    $post = $MySQLiconn->query("SELECT * FROM onemart_post where id = '$post_id' ");
                    $col=$post->fetch_array();

                    $acc = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$shop_id' ");
                    $cc=$acc->fetch_array();

                ?>
                
                <div class="col-xs-12 col-md-4" style="margin-top: 10px;">
                    <div class="card w3-card-24" style="border: 1px solid #02b875;">
                        <div class="card-header" style="background-color:#fff;">
                            <div class="row">
                                <div class="col-2">
                                    <img class="demo-avatar" src="shop_profile/<?php echo $cc['shop_photo']; ?>" alt="Card image cap" style="width: 40px; height: 40px;">
                                </div>
                                <div class="col-8">
                                    <a href="my_wall.php?uid=<?php echo $cc['id']; ?>" style="font-weight: bold;color: #02b875;text-decoration: none;">     <?php echo $cc['shop_name']; ?> 
                                    </a>
                                    <div style="color:#888;font-size: 11px;text-transform: lowercase"> 
                                        @onemart &nbsp;&nbsp; 
                    
                                        <?php if($col['taker'] == 1 ){ ?>
                    
                                        <i style="color:red;" class="fa fa-star" title="Allow Order Taking"></i>
                    
                                        <?php } ?>
                                    
                                    </div>
                                </div>
        
                                <div class="col-2">
                                    <a href="#" class="" id="save<?php echo $post_id; ?>">
                                        <i style="color: #02b875;text-align: right;" class="fa fa-caret-down"> </i>
                                    </a>
                                    <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="save<?php echo $post_id; ?>">
                                        <li class="mdl-menu__item"> 
                                            <i class="fa fa-remove"></i> 
                                            <a style="text-decoration: none;" href="?uid=<?php echo $id; ?>&post_id=<?php echo $post_id; ?>">
                                                Unsaved 
                                            </a>
                                        </li>
                                    </ul>
                                </div>

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
                            if($rand == 1) {
                      ?>

                          <img class="card-img-top img-fluid img-responsive" src="post/<?php echo $img1; ?>" alt="post image" style="height:350px;">  
                      
                        <?php
                            } elseif ($rand == 2) {
                      ?>

                          <img class="card-img-top img-fluid img-responsive" 
                             src="post/<?php if(!empty($img2)) { echo $img2; }else { echo $img1; }  ?>" alt="post image" style="height:350px;">  
                      
                        <?php 
                            } elseif ($rand == 3) {
                      ?>

                          <img class="card-img-top img-fluid img-responsive" 
                             src="post/<?php if(!empty($img3)) { echo $img3; }else { echo $img1; }  ?>" alt="post image" style="height:350px;">  
                      
                        <?php 
                            }elseif ($rand == 4) {
                      ?>
                         
                            <img class="card-img-top img-fluid img-responsive" src="post/<?php if(!empty($img4)) { echo $img4; }else { echo $img1; }  ?>" alt="post image" style="height:350px;">  
                      <?php 
                            } else {
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
                                <span style="font-size: 14px;"> <i style="color: #02b875;font-weight: bold;margin-top: 15px;"  class="fa fa-eye"> </i>.<?php echo $view_count; ?></span>
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

            <?php if(!empty($id)) { ?>

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
        <?php }else { ?>

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
<?php } ?>

</div>
</div>
</div> <br><br>

<!-- end card content -->
                
</div>
</main>
</div> 
   

<!-- floating shopping cart -->

<?php

if(!empty($id)) {

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

<?php

    } 
} 
else 
{ 

?>

    <a href="cart.php" target="" id="view-source" class="" style="font-size: 18px; text-decoration: none;">
        <span class="dot">
            <i class="fa fa-shopping-cart" style="color: white;margin-top: 20px;"></i>
            <sup style="color: white; font-size: 14px;">0</sup>   
        </span> 
    </a>

<?php } ?>


<!-- end floating shopping cart -->

<!-- Add Jquery to page -->
<script src="jquery-1.8.0.min.js"></script>
<script>
  $(document).ready(function(){
    // when the user clicks on like
    $('.like').on('click', function(){
      var postid = $(this).data('id');
      var shopid = $(this).data('id');
      
          $post = $(this);

      $.ajax({
        url: 'index.php',
        type: 'post',
        data: {
          'liked': 1,
          'postid': postid,
          'shopid': shopid
          
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
      var shopid = $(this).data('id');
        $post = $(this);

      $.ajax({
        url: 'index.php',
        type: 'post',
        data: {
          'unliked': 1,
          'postid': postid,
          'shopid': shopid
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

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>