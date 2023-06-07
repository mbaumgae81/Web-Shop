<?php
// Datei in SQL Database hochladen
include("util.inc.php");


if (!empty($_FILES['image'])) {




//'webshop','shop','shop'

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

            $sql = "INSERT INTO Artikel(bildType ,bild,name,preis) VALUES(?, ?,?,?)";
            $statement = $conn->prepare($sql);
            $statement->bind_param('sssd', $imgType, $imgData,$name, $preis );
            $current_id = $statement->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());
        }
    }

   
     // - integer     
    //d - double
    //s - string
    //b - BLOB   
    // $stmt->bind_param("sdb",$name,$preis,$datei);
    // $datei = $_FILES['image'];       // Fülle Variablen für Statement
    // $name = $_POST['artikelName'];
    // $preis = $_POST['preis'];
    
    $conn->close();


}


?>