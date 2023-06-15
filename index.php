<?PHP
include("php/admin/util.inc.php");
include("php/cart.php");
session_start();

$loggedin = FALSE;      // Standartmässig FALSE bis Prüfung auf TRUE
$isadmin = FALSE;       // Standartmässig FALSE bis Prüfung auf TRUE
$page = '';
$res_per_page = 4;  // Ergebnisse pro Seite ( LIMIT SQL)
// prüfe ob Cart schon existiert
// falls nicht erzeuge neue instanz CART
if (isset($_SESSION['cart'])) {
    $myCart = unserialize($_SESSION['cart']);
    $itemsImKorb = $_SESSION['itemsImKorb'];
} else {
    $myCart = new cart();
    $_SESSION['itemsImKorb'] = 0;
    $_SESSION['cart'] = serialize($myCart);
}
// Read user und setze bool
if (isset($_SESSION['user'])) { // Wenn eingelogt dann Bool TRUE
    if ($_SESSION["user"] == "yes") {
        $loggedin = TRUE;
    }
}
// Prüfe ob admin
if ($loggedin) {

    $isadmin = $_SESSION['isadmin'];
}

// Pfüft die ob Seitenzahl übergeben wurde
if (isset($_GET['page']) && ctype_digit(strval($_GET['page']))) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
if (isset($_POST['search'])) {      // prüft ob suchergebnisse mitgegeben wurden
    $suche = $_POST['suchbegriff'];
    $search = TRUE;
   } else $search = FALSE;

// Prüft ob Knopf gedrückt wurde
if (isset($_GET['addcart'])) { // Weiterer eintrag in den Warenkorb
    $addID = $_GET['addcart'];
    $menge = 1; // Standart immer 1 bei press on cart
    $myCart->addToCart($addID, $menge);
    $_SESSION['itemsImKorb'] = $myCart->getAnzahlItems();
    $_SESSION['cart'] = serialize($myCart);
}

$start_from = ($page - 1) * $res_per_page;

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/index.css">
    <title>Sitzathlet Webshop</title>
</head>
<body>

<div class="grid-container">

    <!-- Header -->
    <div class="item-1">
        <h1>Sitzathlet Web-Shop</h1>
        <nav class="navi">

            <li><a href="">Aktuelle Angebote </a></li>
            <li><a href="/php/search.php">Suche</a></li>
            <li><a href="/php/warenkorb.php">Warenkorb</a>
                <div class='itemcount'> <?PHP echo "(" . $_SESSION['itemsImKorb'] . ")"; ?></div> <!-- Anzeige der anzahl von items im warenkorb -->
            </li>
            <li><?PHP
                if (!$loggedin) {   // prüfe Logged in und Wechsle MenüPunkt
                    echo '<a href="../php/login.php">Login</a>';
                } else {
                    echo '<a href="../php/logout.php">Logout</a>';
                }
                ?>
            </li>
            <?PHP if ($isadmin) { // prüfe ob admin und zeige adminpanel
                echo '<li><a href="/php/admin/adminpanel.php">AdminPanel</a></li> ';
            }
            ?>

        </nav>
    </div>


    <!-- php part mit while zum auslesen der Daten aus der SB -->
    <?PHP


    $conn = new_db_connect();


    if ($search) {
        $sql = 'SELECT * FROM Artikel where name  like ? limit ?,? ;';
        $result = getArtikelSearch($sql, $start_from, $res_per_page,$suche);
    } else {
        $sql = "SELECT * FROM Artikel limit ?,?";
        $result = getArtikelwith($sql, $start_from, $res_per_page);

    }
    // Prepared Statement


    if (!$result) {
        die('Could not query:' . $conn->error);                                      // Wenn es keine ergbnis gibt wird Fehler ausgeggeben
    }
    ///////////////////////////////////////////////

    // Standart abfrage $sql = "SELECT * FROM Artikel limit ?,?";
    // $result = getArtikelwith($sql, $start_from, $res_per_page);

    $durchlauf = 0; // durchlauf counter für while schleife ( helper) aufbau GRID
    while ($row = $result->fetch_array()) {
        ?>
        <div class="artikel" id="<?php echo getItemnr($durchlauf); ?>">
            <table>
                <tr> <!-- Zeile 1 -->
                    <td rowspan="4">
                        <?PHP echo ' <img height="300em" width="300em" src="data:image/jpeg;base64,' . base64_encode($row['bild']) . '"/>'; ?>
                    </td>
                    <td>
                        Artikel:

                    </td>
                    <td>
                        <?PHP echo($row['name']); ?>
                    </td>
                </tr>
                <tr>    <!-- Zeile 2 -->
                    <td rowspan="2">
                        Artikelbeschreibung:
                    </td>
                    <td rowspan="2">
                        <?PHP echo($row['beschreibung'] . "€"); ?>

                    </td>

                </tr>
                <tr></tr>
                <tr>    <!-- Zeile 3 -->
                    <td>
                        Preis:
                    </td>
                    <td>
                        <?PHP echo($row['preis'] . "€"); ?>
                        <a href="?addcart=<?PHP echo $row['artikelID'] ?>"><img heigt="30em" width="30em"
                                                                                src="img/shopping-cart_full.png"</a>
                    </td>
                </tr>

                <!--            <p>Artikel Beschreibung Preis</p>-->
            </table>
        </div>

        <?php
        $durchlauf++;  // Wird für die Function getTemnr(); benötigt um das entsprechende Grid ID zuzuweisen
    }
    ?>


    <!-- Footer -->
    <div class="item-7">
        <?PHP
        // SQL Abfrage für menge
        $alleartikel = "select * from Artikel";
        $total_pages = getAnzahlergebnisse($alleartikel, $res_per_page);
        echo $total_pages;

        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='?page=" . $i . "'>Seite " . $i . "</a> ";
        }
        // Letzt Seite
        echo "<a href='?page=$total_pages'>" . '[Ende]' . "</a></p>";

        echo '</div>';
        ?>

    </div>

</div>

</body>
</html>