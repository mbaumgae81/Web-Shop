<?php
include("util.inc.php");

if (isset($_POST['zeile'])) {
    echo "<br> test: ".$_POST['zeile'];
    $aktID = $_POST['zeile'];
    echo "zu löschende ID: ".$aktID;
    $conn = new_db_connect();
    $deleteSQL = "DELETE FROM `Artikel` WHERE artikelID = ? ";
    $stmt = $conn->prepare($deleteSQL);
    $stmt->bind_param("s", $aktID);

    $affecteRow = $stmt->execute();
    echo "<br> Gelöschte Zeilen". $affecteRow." Zeile gelöscht";

} else {
    echo "Nichts übergeben";
}
// header('location: abfragealle.php');
?>