<?php
include("util.inc.php");
$conn = new_db_connect();
if ($conn->connect_error) {
    echo "Databayse connection Error";
    die("Connection failed: " . $conn->connect_error);
}

if (!empty($_POST['kategorie'])) {

    $neueKategorie = $_POST['kategorie'];


    $sql = " INSERT INTO Kategorie(bezeichnung) VALUES(?) ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $neueKategorie);
    $stmt->execute();

} else {
    echo " Fehler ";
}

$conn->close();

header('location: neuekategorie.php');
?>