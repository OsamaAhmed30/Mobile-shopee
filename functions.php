<?php 
    //require MySql Connection
    require('database/DBController.php');
    //require MySql Connection
    require('database/product.php');
    require('database/cart.php');
    //Create DBontroller object
    $db = new DBController();
     //Create product object
    $product = new product($db);
    $product_shuffle = $product->getData();
    $cart = new Cart($db);
   
    
    

?>