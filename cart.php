<?php
          ob_start();
        // include header.php
        include("header.php");  
    ?>

    <?php
    

      if($cartItems<1){
        // include empty cart template.php
         include("Template/notFound/_cart_notFound.php");  
      } 
      else{
      // include cart template.php
         include("Template/_cart-template.php");  
      }
      $whishlistItems = $cart->CartItemCount(1,'wishlist');
      if($whishlistItems<1){
         // include empty whishlist template.php
          include("Template/notFound/_wishlist_notFound.php");  
       } 
       else{
       // include whishlist template.php
       include("Template/_wishilist_template.php"); 
       }
     
    
    
    ?>
    
    <?php
     // include new-phones.php
     include("Template/_new-phones.php");
     //include footer.php
        include("footer.php");

    ?>