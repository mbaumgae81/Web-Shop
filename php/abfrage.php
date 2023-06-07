<?php
include("util.inc.php");
$id= 27;
$conn = new_db_connect();

$sql = "SELECT * FROM Artikel WHERE artikelID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_array();

echo '<img src="data:image/jpeg;base64,'.base64_encode($row['bild']).'"/>';
?>