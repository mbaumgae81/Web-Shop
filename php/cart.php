<?php
include("item.php");

class cart
{
    private $cart = array();
    private $anzahlitems;

    function addToCart($id, $menge)
    {
        $idExist = $this->checkForID($id);
        if ($idExist) {                                     // Prüfe ob schon ein Artikel mit derselben ID vorhanden ist
            $key = $this->searchKeyFromID($id);         // lese ID des Array eintrages

            $aktMenge = $this->cart[$key]->getMenge();   // wenn ja, hole mir von eben diesem artikel die menge aus dem cart
            $aktMenge += 1;                              // füge einen hinzu
            $this->cart[$key]->setMenge($aktMenge);      //  und schreibe die neue Menge in den Cart dieser id

        } else {
            // Füge object dem Array hinzu
            $item = new item($id, $menge);
            array_push($this->cart, $item);         // füge neues Object am ende es Arrays an
        }
        $this->updateAnzahlItems();

    }

    function getCart()
    {
        return $this->cart;

    }

    function updateAnzahlItems()
    {
        $this->anzahlitems = count($this->cart);
    }

    function delFromCart($id)
    {
        unset($this->cart[$id]);
        $this->updateAnzahlItems();
    }

    function getAnzahlItems()
    {
        $this->updateAnzahlItems();
        return $this->anzahlitems;
    }

    function clearCart()
    {
        foreach ($this->cart as $key => $i) {
            $this->delFromCart($key);
        }

    }

    function checkForID($id)
    {
        foreach ($this->cart as $key => $i) {
            if ($i->getId() == $id) {
                return TRUE;
            }

        }
        return FALSE;
    }

    function searchKeyFromID($id)
    {
        foreach ($this->cart as $key => $i) {
            if ($i->getId() == $id) {
                return $key;
            }
        }
    }

}

?>