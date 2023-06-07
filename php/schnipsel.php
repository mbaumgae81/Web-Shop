include ("util.inc.php");


echo "Seite wurde aufgerufen";

// If upload button is clicked ...
if (!empty($_FILES['file'])) {

    $conn = new_db_connect("webshop", "webshop","shop");
// Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "/image" . $filename;
  

    $sql = "INSERT INTO Artikel (bild) VALUES ('$filename')";
    $stmt = $conn->prepare($sql);
    
    $stmt->execute();
    $conn->close();

}
else {
    echo "IS NOT SET";
}
