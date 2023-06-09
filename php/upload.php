<?php
// Datei in SQL Database hochladen
include("util.inc.php");

if (!empty($_FILES['image'])) {


$conn = new_db_connect();

if ($conn->connect_error) {
    echo "Databayse connection Error";
    die("Connection failed: " . $conn->connect_error);
    } 

    if (count($_FILES) > 0) {
        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            $imgData = file_get_contents($_FILES['image']['tmp_name']);
            $imgType = $_FILES['image']['type'];
            $name = $_POST['artikelName'];
            $preis = $_POST['preis'];
            $beschreibung = $_POST['beschreibung'];
            $hersteller = $_POST['hersteller'];

            $sql = "INSERT INTO Artikel(bildType ,bild,name,preis, beschreibung, hersteller,verfuegbar) VALUES(?, ?,?,?,?,?)"; // @todo die restlichen einträge nachzihen.
            $statement = $conn->prepare($sql);
            $statement->bind_param('sssdss', $imgType, $imgData,$name, $preis ,$beschreibung, $hersteller);
                //i - integer
                //d - double
                //s - string
                //b - BLOB  
            $current_id = $statement->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());
        }
    }

   
    
    $conn->close();

}
header('location: neueartikel.php');  // nach dem Upload back to admin


?>