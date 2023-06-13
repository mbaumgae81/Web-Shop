<?php
    include ("cartart.php");

    class cart {
        private $cart = array();

        function addToCart($id,$menge){

            // Füge object dem Array hinzu
            $item = new item($id, $menge); 
            $itemId = $item->getId();
            echo $itemId;

            array_push($this->cart, $item);

        }
        
    }
?>