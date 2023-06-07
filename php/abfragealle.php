<?php
include("util.inc.php");

$conn = new_db_connect();

$sql = "SELECT * FROM Artikel";
$stmt = $conn->prepare($sql);

$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die('Could not query:' . mysql_error());
}


    $seite =0;
    $eintragA = $seite;
    $eintragB = $seite+1;
    $eintragC = $seite+2;
    $eintragD = $seite+3;

   $result->data_seek($eintragA); // data seek sprint an eine vorgegebene row
   $row = $result->fetch_array();


   $result->data_seek($eintragB);
   $rowB = $result->fetch_array();
   
  

echo '<img src="data:image/jpeg;base64,'.base64_encode($row['bild']).'"/>';
echo 'Name :'.($row['name']);
echo 'Preis :'.($row['preis']);

echo '<img src="data:image/jpeg;base64,'.base64_encode($rowB['bild']).'"/>';
echo 'Name :'.($rowB['name']);
echo 'Preis :'.($rowB['preis']);


//
$conn->close();

?>