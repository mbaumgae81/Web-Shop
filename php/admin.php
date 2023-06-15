<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

?>
<!-- Form für Datei Upload -->
<form action="upload.php" method="post" enctype="multipart/form-data">
Datei auswählen:  <input type="file" name="image" /> <br>

Artilenamen: <input type="text" name='artikelName'> <br>

Preis: <input type="number" step="0.01" name ='preis'><br>
<!--
Beschreibung: <input type="text" name = 'beschreibung'><br>
Ist verfügbar: <input type="checkbox" name="verfuegbar" id=""><br>
Hersteller: <input type="text" name="hersteller" id=""><br>
-->
<button type="submit" name="upload">upload</button>
</form>

<!--Form ende -->
    
</body>
</html>