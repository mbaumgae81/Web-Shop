<?php
// Diese Klasse wird als Sammel Object für den Warenkorb verwendet und beinhaltet
// ID welche aus der SQL DB gezogen wird
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
        function setMenge($menge){
            $this->menge= $menge;
        }


    }

?>