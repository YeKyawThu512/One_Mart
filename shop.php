<?php
include("header.php");

if(!empty($_GET['cat']))
{
    $cat = $_GET['cat'];
    $post = $MySQLiconn->query("SELECT * FROM onemart_acc where category = '$cat' order by created_date desc");
}
elseif(!empty($_GET['shop']))
{
    $shop = htmlspecialchars($_GET['shop']);
        
    $post = $MySQLiconn->query("SELECT * FROM onemart_acc where shop_name  LIKE '%$shop%' or address  LIKE '%$shop%' order by created_date desc");
       
    $ser_count = $post->num_rows;
}
else
{
    $post = $MySQLiconn->query("SELECT * FROM onemart_acc order by RAND ()");
    $shop_list = $post->num_rows;   
}

if(isset($_POST['liked']))
{

    $shop_id      = $_POST['postid'];

    $k = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$shop_id' ");
    $mk=$k->fetch_array();
    $n = $mk['check_count'];
        
    $MySQLiconn->query("INSERT INTO onemart_shop_check(user_id, shop_id, created_date, modified_date) VALUES('".$id."', '".$shop_id."', now(), now())"); 

    $MySQLiconn->query("UPDATE onemart_acc SET check_count = $n+1 WHERE id='$shop_id'"); 

    echo $n+1;
    exit();
}

if(isset($_POST['unliked']))
{   
    $shop_id      = $_POST['postid'];

    $k = $MySQLiconn->query("SELECT * FROM onemart_acc where id = '$shop_id' ");
    $mk=$k->fetch_array();
    $n = $mk['check_count'];
      

    $MySQLiconn->query("DELETE FROM onemart_shop_check WHERE user_id = '$id' and shop_id = '$shop_id'");
    $MySQLiconn->query("UPDATE onemart_acc SET check_count = $n-1 WHERE id='$shop_id'"); 

    echo $n-1;
    exit();
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
                <span class="mdl-layout-title">Shop List</span>
                <div class="mdl-layout-spacer"></div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                        <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                            <i class="material-icons">search</i>
                        </label>
                        <div class="mdl-textfield__expandable-holder">
                            <form name="search" action="shop.php" method="get" >
                                <input name="shop" class="mdl-textfield__input" type="text" id="search" value="<?php  if(!empty($shop)){ echo $shop; }?>">
                                <label class="mdl-textfield__label" for="search"></label>
                            </form>
                        </div>
                    </div>
                    <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" href="shop.php" id="">
                        <i class="material-icons">refresh</i>
                    </a>
            </div>
        </header>

        <!-- nav -->
        <?php include("nav.php"); ?>
        <!-- end nav -->
      
        <main class="mdl-layout__content mdl-color--grey-100">
            <div class="mdl-grid demo-content">
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
                    <?php  
                        if(!empty($shop))
                        {
                    ?>
                    <h3 style="text-align: center;color: #02b875;font-weight: bold;font-style: italic;text-decoration: none;" class="zawgyi">  
                        <?php echo $shop; ?> <span class="badge" style="background-color: #02b875;color: white;"><?php echo $ser_count; ?></span>    
                    </h3>
                    <?php
                        } 
                    ?>
                    <!-- end search name -->
                    
                    <div class="row">
                    
                    <?php  
                    while($col=$post->fetch_array()) 
                    { 

                        $shop_id      = $col['id'];
                        $category     = $col['category'];
    
                        $acc = $MySQLiconn->query("SELECT * FROM onemart_post where shop_id = '$shop_id' ");
                        $cc  = $acc->num_rows; 
    
                        $cate = $MySQLiconn->query("SELECT * FROM onemart_category where id = '$category' ");
                        $icon=$cate->fetch_array();

                        $cart_check = $MySQLiconn->query("SELECT id FROM onemart_shop_check where shop_id = '$shop_id' ");
                        $shop_count = $cart_check->num_rows;
       
                        if(!empty($col['shop_name']))
                        {

                    ?>

                    <div class="col-md-4" style="margin-top: 30px;">
                        <div class="card" style="">
                            <div class="" style="text-align: center;background: white;color: #02b875;height: 50px;">
                                <p class="zawgyi" style="line-height: 50px;font-size: 16px;font-weight: bold;">
                                    <?php echo $col['shop_name']; ?> &nbsp; <i class="fa fa-<?php echo $icon['icon']; ?>"></i>
                                </p>
                            </div>
                            <a href="my_wall.php?uid=<?php echo $col['id']; ?>">
                                <img style="height: 230px;" class="card-img-top" src="shop_profile/<?php echo $col['shop_photo']; ?>" alt="Card image cap"> 
                            </a>
  
                            <div class="" style="text-align: center;background: white;color: #02b875;height: 50px;">
                                <p class="zawgyi" style="line-height: 50px;font-size: 16px;">
                                    <?php echo $icon['category']; ?> Shop.
                                </p>
                            </div>
  
                            <div class="card-body" style="background: white; color: #02b875;">
                                <div class="row">
                                    <div class="col-6" style="text-align: center;">
                                        <a href="#" class="card-link" style="font-size: 16px;">     <?php echo $cc; ?> &nbsp; Posts
                                        </a>
                                    </div>

                                    <?php

                                        $active = $MySQLiconn->query("SELECT id FROM onemart_shop_check where user_id = '$id' and shop_id = '$shop_id' ");
                                        $active_count = $active->num_rows;

                                        if ( $active_count == 1 ) 
                                        {  
                                    ?>
                                    
                                    <!-- user already likes -->
                                    <span class="unlike fa fa-thumbs-up" data-id="<?php echo $shop_id; ?>"></span> 
                                    <span class="like hide fa fa-thumbs-o-up" data-id="<?php echo $shop_id; ?>"></span>  

                                    <?php } else { ?>


                                    <span class="like fa fa-thumbs-o-up" data-id="<?php echo $shop_id; ?>"></span> 
                                    <span class="unlike hide fa fa-thumbs-up" data-id="<?php echo $shop_id; ?>"></span> 

                                    <?php } ?>
                                    
                                    &nbsp; &nbsp;
                                    <span class="likes_count">
                                        <?php echo $col['check_count']; ?> likes
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } 
                    ?>
                </div>
                <!-- end card content -->
            </div>
        </div>
    </main>
</div>
   
<!-- floating shopping cart -->
<?php

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

<?php 
} 
?>
<!-- end floating shopping cart -->


<!-- Add Jquery to page -->
<script src="jquery-1.8.0.min.js"></script>
<script>
  $(document).ready(function(){
    // when the user clicks on like
    $('.like').on('click', function(){
      var postid = $(this).data('id');
          $post = $(this);

      $.ajax({
        url: 'shop.php',
        type: 'post',
        data: {
          'liked': 1,
          'postid': postid
        },
        success: function(response){
          $post.parent().find('span.likes_count').text(response + " likes");
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
        url: 'shop.php',
        type: 'post',
        data: {
          'unliked': 1,
          'postid': postid
        },
        success: function(response){
          $post.parent().find('span.likes_count').text(response + " likes");
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
