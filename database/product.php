<?php

    // use to fetch product data
    class product{
        public $db=null;
    
        public function __construct(DBController $db)
        {
            if(!isset($db->con)) return null;
            
            $this->db=$db;
            
        }


        //fetch product data using getData Method

           public function getData($table='product'){
           
            $result = $this->db->con->query("SELECT * FROM {$table}");
            

            $resultArray = array();
    
            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }
    
            return $resultArray;

           }
           public function getitem($itemid=null,$table='product'){
            if ($itemid==null) {
                $itemid=$_GET['item_id'];
            }
           
            $items = $this->db->con->query("SELECT * FROM {$table} WHERE item_id={$itemid}");
           

            $resultArray = array();
    
            // fetch product data one by one
            while ($item = mysqli_fetch_array($items, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }
    
            return $resultArray;

           }

    }

?>