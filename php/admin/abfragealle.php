<?php
// TODO mit mehreren abfragen testen !! derzeit zu wenige einträge .

session_start();
if (!checkForAdmin()) {
    die(' Du kommst hier nicht rein !');
}
// GET Variable
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


include("adminheader.php");
include("util.inc.php");

$conn = new_db_connect();

$sql = "SELECT * FROM Artikel limit ?,?";                                           // Prepared Statement
$stmt = $conn->prepare($sql);                                                       // Prepared Statement
$stmt->bind_param("dd", $start_from, $res_per_page);               // Prepared Statement

$stmt->execute();
$result = $stmt->get_result();


if (!$result) {
    die('Could not query:' . $conn->error);                                      // Wenn es keine ergbnis gibt wird Fehler ausgeggeben
}
//
//$seite = 0;
//$eintragA = $seite;
//$eintragB = $seite + 1;
//$eintragC = $seite + 2;
//$eintragD = $seite + 3;
//
//$result->data_seek($eintragA); // data seek springt an eine vorgegebene row
//$row = $result->fetch_array();
//
//$result->data_seek($eintragB);
//$rowB = $result->fetch_array();
//
//$result->data_seek($eintragC);
//$rowC = $result->fetch_array();
//
//$result->data_seek($eintragD);
//$rowD = $result->fetch_array();
//

?>
<!doctype html>
<html lang=de>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<form action="func_deleteArtikel.php" method="post">
    <body>
    <table>
        <tr>
            <th>Artikel Bild</th>
            <th>Artikel Name</th>
            <th>Artikel Preis</th>
            <th>Artikel Beschreibung</th>
            <th>Hersteller</th>
            <th>verfuegbar</th>
            <th>Löschen</th>
            <th>Kategorie</th>
        </tr>

        <?PHP

        while ($row = $result->fetch_array() ){
            ?>

        <tr>
            <td><?PHP echo ' <img height="200px" width="200px" src="data:image/jpeg;base64,' . base64_encode($row['bild']) . '"/>'; ?></td>
            <td><?PHP echo 'Name :' . ($row['name']); ?></td>
            <td><?PHP echo($row['preis'] . "€"); ?></td>
            <td><?PHP echo($row['beschreibung'] . "€"); ?></td>
            <td><?PHP echo($row['hersteller']); ?></td>
            <td><?PHP echo($row['verfuegbar']); ?></td>
            <td>

                <label>
                    <input type="radio" name="zeile" value="<?PHP echo $row['artikelID'] ?>">
                </label>
            </td>
            <td>
                <?PHP echo($row['kategorieA']); ?>
            </td>
            <?PHP
            }
            ?>
        </tr>



    </table>
    <div>
    <input type="submit" name="löschen" value="löschen">
        <input type="submit" name="edit"  value="edit" formaction="editartikel.php"> </input>
    </div>
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

    </body>

</form>
