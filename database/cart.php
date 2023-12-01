<?php

    //cart class
    class Cart{
        public $db=null;
    
        public function __construct(DBController $db)
        {
            if(!isset($db->con)) return null;
            
            $this->db=$db;
            
        }
        public function insertIntoCart($params = null , $table='cart'){
           if($this->db->con!=null){
            if($params !=null){
                $columns = implode(',' , array_keys($params));
                $values = implode(',' , array_values($params));

                $query_string = sprintf('INSERT INTO %s(%s) VALUES (%s)',$table ,$columns,$values);
                $result = $this->db->con->query($query_string);
                return $result;  
               
            }
           }
        } 
        // to get user_id and item_id and insert into cart table
        public  function addToCart($userid, $itemid){
        if (isset($userid) && isset($itemid)){
            $params = array(
                "user_id" => $userid,
                "item_id" => $itemid
            );

            // insert data into cart
            $result = $this->insertIntoCart($params);
            if ($result){
                 // Reload Page
                 header("Location: " . $_SERVER['PHP_SELF']);
                }
            }
        }
        public function CartItems($userid = 1 , $table='cart' ){
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE user_id = {$userid}");
            $resultArray = array();
    
            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }
    
            return $resultArray;
           
        }
        public function CartItemCount($userid = 1 , $table='cart' ){
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE user_id = {$userid}")->fetch_all();
           
            return count($result);
        }

        // delete cart item using cart item id
        public function deleteCart($item_id = null,$userid = 1, $table = 'cart'){
            if($item_id != null){
                $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id} AND user_id={$userid}");
                print_r($result);
                if($result){
                    header("Location:" . $_SERVER['PHP_SELF']);
                   
                }
                return $result;
            }
        }

        // calculate sub total
        public function getSum($arr){
            if(isset($arr)){
                
                $sum = 0;
                foreach ($arr as $item){
                    $sum += floatval($item[0]);
                }
                return sprintf('%.2f' , $sum);
            }
        }

        // get item_it of shopping cart list
        public function getCartId($cartArray = null, $key = "item_id",$userid=1){
            if ($cartArray != null){
                
                $cart_id = array_map(function ($value) use($key,$userid){
                    if($value['user_id']== $userid){
                    return $value[$key];
                }}, $cartArray);
            }
                return $cart_id;
            }
        

        // Save for later
        public function saveForLater($item_id = null, $saveTable = "wishlist", $fromTable = "cart"){
            if ($item_id != null){
                $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE item_id={$item_id};";
                $query .= "DELETE FROM {$fromTable} WHERE item_id={$item_id};";

                // execute multiple query
                $result = $this->db->con->multi_query($query);

                if($result){
                    header("Location:" . $_SERVER['PHP_SELF']);
                   
                }
                return $result;
            }
        } 
          
    }
    


     
    
?>