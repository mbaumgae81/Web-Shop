<?php
include ("../php/admin/util.inc.php");
include ("cart.php");
session_start();

    $conn = new_db_connect();

    if (isset($_SESSION['cart'])){
        $myCart =  unserialize($_SESSION['cart']);
    }

    if (isset($_GET['deleteitem'])){
        $iddel = $_GET['deleteitem'];
        $myCart->delFromCart($iddel);
        $_SESSION['cart'] = serialize($myCart);
        header("Location: warenkorb.php");
    }
    if (isset($_GET['Aktualisieren'])){
        foreach ($myCart->getCart() as $key=>$i) {
         $i->setMenge($_GET[$key]);
        }
    }

//    $myCart = $_SESSION['cart'];
///
//$myCart = unserialize( $_SESSION['cart']);

    // Zeige artikel des Warenkorbs an
?> 

<!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" href="../css/warenkorb.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<table>
<tr>
    <th>Artikel</th>
    <th>Preis einzeln</th>
    <th>Menge</th>
    <th>Preis Gesamt</th>
    <th>löschen</th>
    <th>KEY</th>

</tr>
<?php
        $akteintrag =0;  // zum zählen der Array Position
    foreach($myCart->getCart() as $key=>$i){
        $artID= $i->getId();

        $sql = "Select * FROM Artikel where artikelID = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$artID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array();

?>
    <form>
        <tr>
            <td>
                <?PHP echo $row['name']; ?>
            </td>
            <td>
                <?PHP echo $row['preis']; ?> 
            </td>
            <td>
                <input type="number" value="<?PHP echo $i->getMenge(); ?>" name="<?PHP echo $key?>" >

            </td>

            <td>
                <?PHP echo $row['preis'] * $i->getMenge(); ?> 
            </td>
            <td><a href="?deleteitem=<?php echo $key; ?>" >
                <img heigt="30em" width="30em"
                     src="../img/remove.png"></a>
            </td>
            <td>
                <?PHP echo $key; ?>
            </td>


    </tr>
     <td>



     <?php
     $akteintrag++;
    }
?>
         <input type="submit" value="Aktualisieren" name="Aktualisieren">
    </form>
</table>




</body>
</html>

<?php

   

?>