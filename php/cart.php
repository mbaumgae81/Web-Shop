<?php
    include ("item.php");

    class cart {
        private $cart = array();
        private $anzahlitems;

        function addToCart($id,$menge){

            // Füge object dem Array hinzu
            $item = new item($id, $menge); 
            //$itemId = $item->getId();
            array_push($this->cart, $item);
            $this->updateAnzahlItems();

        }

        function getCart(){
            return $this->cart;
            
        }
        function updateAnzahlItems(){
            $this->anzahlitems = count($this->cart);
        }

        function delFromCart($id){
            unset($this->cart[$id]);
            $this->updateAnzahlItems();
        }
        function getAnzahlItems(){
            $this->updateAnzahlItems();
            return $this->anzahlitems;
        }
    }
?>