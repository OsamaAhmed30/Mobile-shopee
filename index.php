    <?php
      ob_start();
         // include header.php
         include("header.php");  
    ?>

    <?php
     // include banner-area.php
        include("Template/_banner-area.php");
     // include top-sale.php
        include("Template/_top-sale.php");
     // include special-price.php
        include("Template/_special-price.php");
     // include bannerTemplate/_adds.php
        include("Template/_banner_adds.php");
     // include new-phones.php
        include("Template/_new-phones.php");
     // include blogs.php
        include("Template/_blogs.php");
    ?>
    
    <?php
     //include footer.php
        include("footer.php");

    ?>