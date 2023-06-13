<?php
    include ("item.php");

    class cart {
        private $cart = array();

        function addToCart($id,$menge){

            // Füge object dem Array hinzu
            $item = new item($id, $menge); 
            $itemId = $item->getId();
            

            array_push($this->cart, $item);

        }

        function getCart(){
            return $this->cart;
            
        }
    }
?>