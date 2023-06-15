<?PHP

include("php/admin/util.inc.php");
$page = '';

// Pfüft die GET Variable, ob gesetzt und vom Typ integer
if (isset($_GET['page']) && ctype_digit(strval($_GET['page']))) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
// Ergebnisse pro Seite
$res_per_page = 4;
$start_from = ($page - 1) * $res_per_page;

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/index.css">
    <title>Sitzathlet</title>
</head>
<body>

<div class="grid-container">

    <!-- Header -->
    <div class="item-1">
        <h1>Sitzathlet Web-Shop</h1>
        <nav class="navi">
            <!--      <li>Hallo</li>-->

            <li><a href="">Aktuelle Angebote </a></li>
            <li><a href="/php/search.php">Suche</a></li>
            <li><a href="/php/cart.php">Warenkorb</a></li>
            <li><a href="/php/login.php">Login</a></li>
            <li><a href="/php/admin/adminpanel.php">AdminPanel</a></li>
        </nav>
    </div>

    <!-- Menu -->
    <div class="sidebar">
        <h2>Menu</h2>
        <ol>Auswahl 1</ol>
        <ol>Auswahl 2</ol>
        <ol>Auswahl 3</ol>
        <ol>Auswahl 4</ol>
    </div>

    <!-- Contet -->
    <!-- php part mit while zum auslesen der Daten aus der SB -->
    <?PHP
    $conn = new_db_connect();

    $sql = "SELECT * FROM Artikel limit ?,?";                                           // Prepared Statement
    $stmt = $conn->prepare($sql);                                                       // Prepared Statement
    $stmt->bind_param("dd", $start_from, $res_per_page);               // Prepared Statement

    $stmt->execute();
    $result = $stmt->get_result();


    if (!$result) {
        die('Could not query:' . $conn->error);                                      // Wenn es keine ergbnis gibt wird Fehler ausgeggeben
    }
    $durchlauf = 0;
    while ($row = $result->fetch_array()) {
//            echo $durchlauf;
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
                        <a href="" ><img heigt="30em" width="30em" src="img/shopping-cart_full.png"</a>
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
        $db = "select * from Artikel";
        $result = $conn->query($db);
        // Anzahl der Ergebnisse aus SQL Abfrage
        $total_records = $result->num_rows;
        // Ergebnisse gesamt durch Ergebnisse pro Seite teilen
        $total_pages = ceil($total_records / $res_per_page);
        $conn->close();
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='?page=" . $i . "'>Seite " . $i . "</a> ";
        }
        // Letzt Seite
        echo "<a href='?page=$total_pages'>" . '[Ende]' . "</a></p>";

        echo '</div>';
        ?>
        <?php // $seite = $seite + 4; ?>

    </div>

</div>

</body>
</html>