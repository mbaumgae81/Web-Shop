<?php
include("../php/admin/util.inc.php");
include("cart.php");
session_start();
$bestelldone = FALSE;
$conn = new_db_connect();

if (isset($_SESSION['cart'])) {
    $myCart = unserialize($_SESSION['cart']);
}
if (isset($_GET['Bestellungdone'])){
    $bestelldone = TRUE;
}

if (isset($_GET['deleteitem'])) {
    $iddel = $_GET['deleteitem'];
    $myCart->delFromCart($iddel);
    $_SESSION['itemsImKorb'] = $myCart->getAnzahlItems();

    $_SESSION['cart'] = serialize($myCart);
    header("Location: warenkorb.php");
}
if (isset($_GET['Aktualisieren'])) {
    foreach ($myCart->getCart() as $key => $i) {
        $i->setMenge($_GET[$key]);
    }
}
if (isset($_GET['order'])) {
    // Bestellung  @TODO Funktion Testen Datensätze schreiben
    if (isset($_SESSION['user'])) {
        $userID = $_SESSION['userID'];
        $date = date("Y-m-d H:i:s");
        // erstelle die Bestellung und hole die Last ID

        $sql = "INSERT INTO `Bestellungen`( `datum`, `userID`) VALUES (?,?)";
        $conn = new_db_connect();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $date, $userID);
        $stmt->execute();
        $orderID = $conn->insert_id;
        echo " Bestell ID: " . $orderID;
        // Schreiben alle ArtikelIDs in Tabelle Artikel POS
        // zu der Bestellung wird jeder artikel als Position aufgeführt
        foreach ($myCart->getCart() as $key => $i) {
            $artID = $i->getId();
            $menge =$i->getMenge();
            $sql = "INSERT INTO `BestellungenPos`( `bestellungID`, artikelID,`anzahl` ) VALUES (?,?,?)";
            $conn = new_db_connect();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $orderID, $artID, $menge);
            $stmt->execute();
        }
        $myCart->clearCart();
        $_SESSION['cart'] = serialize($myCart);
        $conn->close();
        header ('location: ?Bestellungdone');
    } else {
        header ('location: login.php');
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
            <!--    <th>KEY</th>-->

        </tr>
        <?php
        $Total = 0;
        $akteintrag = 0;  // zum zählen der Array Position
        $conn = new_db_connect();
        foreach ($myCart->getCart() as $key => $i){
        $artID = $i->getId();

        $sql = "Select * FROM Artikel where artikelID = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $artID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array();
        $rowGesPreis = $row['preis'] * $i->getMenge();
        $Total += $rowGesPreis;
        ?>
        <form>
            <tr>
                <td>
                    <?PHP echo $row['name']; ?>
                </td>
                <td>
                    <?PHP $ausgabe = sprintf("%01.2f", $row['preis']);
                    echo $ausgabe . "€"; ?>
                </td>
                <td>
                    <input type="number" value="<?PHP echo $i->getMenge(); ?>" name="<?PHP echo $key ?>">

                </td>

                <td>
                    <?PHP $ausgabe = sprintf("%01.2f", $rowGesPreis);
                    echo $ausgabe . "€"; ?>
                </td>
                <td><a href="?deleteitem=<?php echo $key; ?>">
                        <img heigt="30em" width="30em"
                             src="../img/remove.png"></a>
                </td>


            </tr>
            <td>


                <?php
                $akteintrag++;
                }
                ?>
    </table>
    <input type="submit" value="Aktualisieren" name="Aktualisieren">
    <p>Gesamt Preis Bestellung: <?PHP $ausgabe = sprintf("%01.2f", $Total);
        echo $ausgabe . "€"; ?> </p> <br>
    <input type="submit" value="Bestellen" name="order">
    </form>

    <?PHP if ($bestelldone) { echo " <h1>Ihre Bestellung wurde abgeschickt</h1> ";} ?>
    </body>
    </html>

<?php


?>