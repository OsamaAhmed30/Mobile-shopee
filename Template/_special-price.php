<?php
  $brand = array_map(function($pro){return $pro['item_brand'];},$product_shuffle);
  $uniqeBrand = array_unique($brand);
  sort($uniqeBrand);
  shuffle($product_shuffle);
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['special_price_submit'])){
  $itemId=$_POST['itemId'];
  $userId=$_POST['userId'];
  if(!empty($itemId) && !empty($userId)){
  $cart->addToCart($userId,$itemId);
  }
    }
  }
  $in_cart = $cart->getCartId($product->getData('cart'));
?>

<!-- Special Price -->
    <section id="special-price">
      <div class="container">
        <h4 class="font-rubik font-size-20">Special Price</h4>
        <div id="filters" class="button-group text-right font-baloo font-size-16">
          <button class="btn is-checked" data-filter="*">All Brand</button>
         
          <?php 
            
            array_map(function($brand)use($in_cart) 
            {
              printf('<button class="btn" data-filter=".%s">%s</button>',$brand,$brand);
            },
            $uniqeBrand)
              ?>
            
         
         
        </div>
       
        <div class="grid">
        <?php 
              foreach($product_shuffle as $item):
            ?>
        <?php
            if (!empty($item['item_brand']) && !empty($item['item_name']) && !empty($item['item_price']) && !empty($item['item_image'])):
             
          ?>
          <div class="grid-item <?php echo $item['item_brand'];?> border">
           <div class="item py-2" style="width: 200px;">
            <div class="product font-rale">
            <a href="<?php printf('%s?item_id=%s','product.php',$item['item_id']) ?>"><img src="<?php echo $item['item_image'];?>" alt="product1" class="img-fluid"></a>
              <div class="text-center">
                <h6><?php echo $item['item_name'];?></h6>
                <div class="rating text-warning font-size-12">
                  <span><i class="fas fa-star"></i></span>
                  <span><i class="fas fa-star"></i></span>
                  <span><i class="fas fa-star"></i></span>
                  <span><i class="fas fa-star"></i></span>
                  <span><i class="far fa-star"></i></span>
                </div>
                <div class="price py-2">
                  <span><?php echo $item['item_price'];?></span>
                </div>
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                      <input type="hidden" name="itemId" value="<?php echo $item['item_id']?>"/>
                      <input type="hidden" name="userId" value="<?php echo $item['user_id']?? 1?>"/>
                      <?php
                                if (in_array($item['item_id'], $in_cart ?? [])){
                                    echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
                                }else{
                                    echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                                }
                                ?>
                    </form>
              
              </div>
            </div>
          </div>
          </div>
          <?php endif ?>
          <?php endforeach ?>
        </div>
      </div>
    </section>
<!-- !Special Price -->