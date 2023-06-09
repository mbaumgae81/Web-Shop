<?php
// TODO mit mehreren abfragen testen !! derzeit zu wenige einträge .

session_start();
// GET Variable
$page = '';

// Pfüft die GET Variable, ob gesetzt und vom Typ integer
if (isset($_GET['page']) && ctype_digit(strval($_GET['page']))) {
    $page = $_GET['page'];
    echo " isset";
} else {
    $page = 1;
}
// Ergebnisse pro Seite
$res_per_page = 4;
$start_from = ($page-1) * $res_per_page;


include("adminheader.php");
include("util.inc.php");

$conn = new_db_connect();

$sql = "SELECT * FROM Artikel limit ?,?";                                           // Prepared Statement
$stmt = $conn->prepare($sql);                                                       // Prepared Statement
$stmt->bind_param("dd",  $start_from, $res_per_page);               // Prepared Statement

$stmt->execute();
$result = $stmt->get_result();


if (!$result) {
    die('Could not query:'. $conn->error);                                      // Wenn es keine ergbnis gibt wird Fehler ausgeggeben
}


    $seite =0;
    $eintragA = $seite;
    $eintragB = $seite+1;
    $eintragC = $seite+2;
    $eintragD = $seite+3;

   $result->data_seek($eintragA); // data seek springt an eine vorgegebene row
   $row = $result->fetch_array();

   $result->data_seek($eintragB);
   $rowB = $result->fetch_array();

    $result->data_seek($eintragC);
    $rowC = $result->fetch_array();

    $result->data_seek($eintragD);
    $rowD = $result->fetch_array();





//

?>

<body>
<table>
    <tr>
        <td><?PHP echo '<img height="200px" width="200px" src="data:image/jpeg;base64,'.base64_encode($row['bild']).'"/>'; ?></td>
        <td><?PHP echo 'Name :'.($row['name']); ?></td>
        <td><?PHP echo 'Preis :'.($row['preis']."€"); ?></td>
        <td></td>

    </tr>
    <tr>
        <td><?PHP echo '<img height="200px" width="200px" src="data:image/jpeg;base64,'.base64_encode($rowB['bild']).'"/>'; ?></td>
        <td><?PHP echo 'Name :'.($rowB['name']); ?></td>
        <td><?PHP echo 'Preis :'.($rowB['preis']."€"); ?></td>
        <td></td>

    </tr>
    <tr>
        <td><?PHP echo '<img height="200px" width="200px" src="data:image/jpeg;base64,'.base64_encode($rowC['bild']).'"/>'; ?></td>
        <td><?PHP echo 'Name :'.($rowC['name']); ?></td>
        <td><?PHP echo 'Preis :'.($rowC['preis']."€"); ?></td>
        <td></td>

    </tr>
    <tr>
        <td><?PHP echo '<img height="200px" width="200px" src="data:image/jpeg;base64,'.base64_encode($rowD['bild'] ) .'"/>'; ?></td>
        <td><?PHP echo 'Name :'.($rowD['name']); ?></td>
        <td><?PHP echo 'Preis :'.($rowD['preis']."€"); ?></td>
        <td></td>

    </tr>
</table>
<?PHP
// SQL Abfrage für menge
$db = "select * from Artikel";
$result = $conn->query($db);
// Anzahl der Ergebnisse aus SQL Abfrage
$total_records = $result->num_rows;
// Ergebnisse gesamt durch Ergebnisse pro Seite teilen
$total_pages = ceil($total_records / $res_per_page);
$conn->close();
?>

<?php
// Navigations Links nächste Seite etc.

// echo "<p><a href='./'>".'[Start]'."</a> ";
    // For Schleife für Seitendurchlauf
    for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='?page=".$i."'>Seite ".$i."</a> ";
    }
    // Letzt Seite
    echo "<a href='?page=$total_pages'>".'[Ende]'."</a></p>";

echo '</div>';
?>
<?php $seite=$seite+4;?>
<?php //echo $seite;
echo $_SESSION['capnum'];
?>
</body>

</html>
