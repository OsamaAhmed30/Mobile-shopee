 
 <?php
   
    $cartitems=$cart->CartItems();
    foreach($cartitems as $items){
        $productData = $product->getitem($items['item_id']);
        
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
       if(isset($_POST['delete_cart_submit'])){
        $itemId=$_POST['itemId'];
        $userId=$_POST['userId'];
       if(!empty($itemId)){
      $cart->deleteCart($itemId);
      }
        }
        if (isset($_POST['wishlist-submit'])){
        $itemId=$_POST['itemId'];
        $userId=$_POST['userId'];
            $cart->saveForLater($itemId);
    }
      }
    // echo"<pre>";
    // print_r( $productData);
    // echo"</pre>";
    
 ?>
 <!-- Shopping cart section  -->
 <section id="cart" class="py-3">
    <div class="container-fluid w-75">
        <h5 class="font-baloo font-size-20">Shopping Cart</h5>

    <!--  shopping cart item   -->
        <div class="row">
            <div class="col-sm-9">

                <?php 
                foreach($cartitems as $items):
                $productData = $product->getitem($items['item_id']);
                  $subtotal[]=array_map(function($product){
                
                ?>
                <!-- cart item -->
                    <div class="row border-top py-3 mt-3">
                        <div class="col-sm-2">
                            <img src="<?php echo $product['item_image']?>" style="height: 120px;" alt="cart1" class="img-fluid">
                        </div>
                        <div class="col-sm-8">
                            <h5 class="font-baloo font-size-20"><?php echo $product['item_name']?></h5>
                            <small><?php echo $product['item_brand']?></small>
                            <!-- product rating -->
                            <div class="d-flex">
                                <div class="rating text-warning font-size-12">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                    </div>
                                    <a href="#" class="px-2 font-rale font-size-14">20,534 ratings</a>
                            </div>
                            <!--  !product rating-->

                <!-- product qty -->
                    <div class="qty d-flex pt-2">
                        <div class="d-flex font-rale w-25">
                            <button class="qty-up border bg-light" data-id="<?php echo $product['item_id'] ?? 0 ?>"><i class="fas fa-angle-up"></i></button>
                            <input type="text" data-id="<?php echo $product['item_id'] ?? 0 ?>" class="qty_input border px-2 w-100 bg-light" disabled value="1" placeholder="1">
                            <button data-id="<?php echo $product['item_id'] ?? 0 ?>" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                        </div>
                <form  method="post">
                      <input type="hidden" name="itemId" value="<?php echo $product['item_id']?>"/>
                      <input type="hidden"  name="userId" value="1"/>
                      <button type="submit" name="delete_cart_submit" class="btn font-baloo text-danger px-3 border-right">Delete</button>
                      <button type="submit" name="wishlist-submit" class="btn font-baloo text-danger">Save for Later</button>
                </form>
                
               
               </div>
                            <!-- !product qty -->

                        </div>

                        <div class="col-sm-2 text-right">
                            <div class="font-size-20 text-danger font-baloo">
                                $<span class="product_price" data-id="<?php echo $product['item_id'] ?? 0 ?>"><?php echo $product['item_price']?></span>
                            </div>
                        </div>
                    </div>
                <?php
                    return $product['item_price'];
                    },$productData);
                   
                endforeach  

                ?>
                <!-- !cart item -->
              
            </div>
            <!-- subtotal section-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Your order is eligible for FREE Delivery.</h6>
                    <div class="border-top py-4">
                        <h5 class="font-baloo font-size-20">Subtotal (<?php echo $cart-> CartItemCount(); 
                        echo $cart-> CartItemCount()> 1 ?  ' items' : ' item'?>):&nbsp; <span class="text-danger">$<span class="text-danger" id="deal-price"><?php echo !empty($subtotal) ? $cart-> getSum( $subtotal): 0 ?></span> </span> </h5>
                        <button type="submit" class="btn btn-warning mt-3">Proceed to Buy</button>
                    </div>
                </div>
            </div>
            <!-- !subtotal section-->
        </div>
    <!--  !shopping cart item   -->
    </div>
</section>
            <!-- !Shopping cart section  -->