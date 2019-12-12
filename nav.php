<div class="demo-drawer mdl-layout__drawer" style="background-color: #02b875; color: #fff;">
    
    <header class="demo-drawer-header">
        
        <img src="<?php if(!empty($profile)){ ?> profile/<?php echo $profile;}else{?>logo/My Drawing (JPG).jpg <?php }?>" class="demo-avatar" style="">

            <div class="demo-avatar-dropdown">
                
                <span class="zawgyi"> 
                    <?php if(!empty($name)){ echo $name; }else{ echo 'OneMart'; }?> 
                </span>
                
                <div class="mdl-layout-spacer"></div>
               
                <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                    <i class="material-icons" role="presentation">arrow_drop_down</i>
                    <span class="visuallyhidden">Accounts</span>
                </button>
                
                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                
                <?php 
                if(!empty($id))
                {
                    if(!empty($shop_name)) 
                    {
                ?>
                
               <a href="edit.php" class="zawgyi" style="text-decoration: none;">
                    <li class="mdl-menu__item"><i class="material-icons">face</i>&nbsp;
                        My Account
                    </li>
                </a>
              
                <a href="my_wall.php?uid=<?php echo $id; ?>" class="zawgyi" style="text-decoration: none;">
                    <li class="mdl-menu__item"><i class="material-icons">shopping_cart</i>&nbsp;
                        <?php echo $shop_name; ?>
                    </li>
                </a>
               
                <?php
                    }
                    else
                    {
                ?>

                <a href="edit.php" class="zawgyi" style="text-decoration: none;">
                    <li class="mdl-menu__item"><i class="material-icons">face</i>&nbsp;
                        My Account
                    </li>
                </a>

                <a href="information.php" class="zawgyi" style="text-decoration: none;">
                    <li class="mdl-menu__item"><i class="material-icons">add</i>&nbsp;
                        New Shop 
                    </li>
                </a>

                <?php
                    }
                }   
                else 
                {
                ?>
                
                <a href="logout.php" class="zawgyi" style="text-decoration: none;">
                    <li class="mdl-menu__item"><i class="material-icons">add</i>
                        New Shop 
                    </li>
                </a>

                <?php
                }
                ?>
              
            </ul>
        </div>
    </header>
    
    <nav class="demo-navigation mdl-navigation" style="background-color: #fff;">
            
        <a style="color:#000;text-decoration:none;" class="mdl-navigation__link" href="index.php">
            <i style="color: #000;"  class=" material-icons" role="presentation">dashboard</i>All Products
        </a>
          
        <a style="color:#000;text-decoration:none;" class="mdl-navigation__link" href="categories.php">
            <i style="color: #000;" class=" material-icons" role="presentation">list</i>Categories
        </a>

        <a style="color:#000;text-decoration:none;" class="mdl-navigation__link" href="shop.php">
            <i style="color: #000;"  class=" material-icons" role="presentation">store</i>Shop List
        </a>

        <a style="color: #000;text-decoration: none;" class="mdl-navigation__link" href="save_post.php">
            <i style="color: #000;" class="material-icons" role="presentation">bookmark</i>Saved Post
        </a>
          
        <a style="color: #000;text-decoration: none;" class="mdl-navigation__link" href="receive_form.php">
            <i style="color: #000;" class="material-icons" role="presentation">shopping_basket</i>Receive
        </a>
          
        <a style="color: #000;text-decoration: none;" class="mdl-navigation__link" href="order_taker.php">
            <i style="color: #000;"  class=" material-icons" role="presentation">star</i>
            Order Taker          
            &nbsp;
            <sup>
                <span style="font-size: 12px;" class="badge badge-pill badge-danger">New</span> 
            </sup>
        </a>
          
        <a style="color: #000;text-decoration: none;" class="mdl-navigation__link" href="special_order.php">
            <i style="color: #000;"  class=" material-icons" role="presentation">card_giftcard</i> Special Order
            &nbsp;
            <sup> 
                <span style="font-size: 12px;" class="badge badge-pill badge-danger">New</span> 
            </sup>
        </a>
          
        <p style="color:#fff;background:#02b875;text-align: center;" class="mdl-navigation__link">
            <i style="color: #02b875;" class="material-icons" role="presentation">add_shopping_cart</i>Shop Account
        </p>
          
        <?php if(!empty($shop_name)) { ?>

        <a style="color: #000;text-decoration: none;" class="mdl-navigation__link" href="shop_edit.php">
            <i style="color: #000;" class="material-icons" role="presentation">add_shopping_cart</i>Edit Shop
        </a>

        <?php }  else { ?>

        <a style="color: #000;text-decoration: none;" class="mdl-navigation__link" href="information.php">
            <i style="color: #000;" class="material-icons" role="presentation">add_shopping_cart</i>New Shop
        </a>

        <?php } ?>
          
        <a style="color: #000;text-decoration: none;" class="mdl-navigation__link" href="new_post.php">
            <i style="color: #000;" class="material-icons" role="presentation">add</i>New Post
        </a>
          
        <a style="color:#000;text-decoration:none;" class="mdl-navigation__link" href="like.php">
            <i style="color:#000;"  class=" material-icons" role="presentation">thumbs_up_down</i>
            Like 
            &nbsp;
            <?php if($lcount > 0){ ?>
            <sup>
                <span style="font-size: 12px;" class="badge badge-pill badge-danger">
                    <?php  echo $lcount; ?>      
                </span> 
            </sup>
            <?php } ?>
        </a>
          
        <a style="color:#000;text-decoration:none;" class="mdl-navigation__link" href="views.php">    <i style="color: #000;" class="material-icons" role="presentation">visibility</i>      View & Save List
            &nbsp;
            <?php if($vscount > 0){ ?>
            <sup>
                <span style="font-size: 12px;" class="badge badge-pill badge-danger">
                    <?php  echo $vscount; ?>      
                </span> 
            </sup>
            <?php } ?>
        </a>

        <a style="color: #000;text-decoration: none;" class="mdl-navigation__link" href="comments.php">
            <i style="color: #000;" class="material-icons" role="presentation">comment</i>Comment
          &nbsp;
            <?php if($ccount > 0){ ?>
            <sup>
                <span style="font-size: 12px;" class="badge badge-pill badge-danger">
                    <?php  echo $ccount; ?>      
                </span> 
            </sup>
            <?php } ?>
        </a>

        <a style="color: #000;text-decoration: none;" class="mdl-navigation__link" href="order_list.php">
            <i style="color: #000;" class="material-icons" role="presentation">shopping_cart</i>Order  
            &nbsp;
            <?php if($ocount > 0){ ?>
            <sup>
                <span style="font-size: 12px;" class="badge badge-pill badge-danger">
                    <?php  echo $ocount; ?>      
                </span> 
            </sup>
            <?php } ?>
        </a>
          
        <a style="color: #000;text-decoration: none;" class="mdl-navigation__link" href="deliver.php">
            <i style="color: #000;" class="material-icons" role="presentation">local_shipping</i>Deliver
        </a>
          
        <a style="color: #000;text-decoration: none;" class="mdl-navigation__link" href="logout.php" onClick="return confirm('Are you sure to Logout from OneMart.')">
            <i style="color: #000;" class="material-icons" role="presentation">settings_power</i>Logout
        </a>
            
    </nav>
</div>