<?php
    include ("util.inc.php");
    include ("cart.php");
    $conn = new_db_connect();
    
    $myCart = new cart;
    $myCart->addToCart(1,1);
    $myCart->addToCart(1,2);
    $myCart->addToCart(2,1);
    $myCart->addToCart(3,2);
?>
    // Zeige artikel des Warenkorbs an
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<table>
<tr>
    <td>Artikel</td>
    <td>Preis einzeln</td>
    <td>Menge</td>
    <td>Preis Gesamt</td>

</tr>
<?php 

    foreach($myCart->getCart() as $i){
        $artID= $i->getId();

        $sql = "Select * FROM artikel where artikelID = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$artID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array();
?>

        <tr>
            <td>
                <?PHP echo $row['name']; ?>
            </td>
            <td>
                
            </td>
            <td> </td>
            <td> </td>
    </tr>
     <td>
        
     
     <?php
    }
?>

</table>




</body>
</html>

<?php

    foreach ($myCart->getCart() as $i) {
        echo $i->getID();
        echo $i->getMenge()."<br>";




    }

?>