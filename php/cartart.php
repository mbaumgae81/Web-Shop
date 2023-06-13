<?php
    class item{
        public $id;
        public $menge;
        function __construct($id, $menge){
            $this->id = $id;
            $this->menge = $menge;
        }
        function getId(){
            return $this->id;
        }
        function getMenge(){
            return $this->menge;
        }


    }

?>