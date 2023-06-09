<?php

include("adminheader.php");
?>

<!-- Form für Datei Upload -->
<form action="upload.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td> Datei auswählen:</td>
            <td><input type="file" name="image" /> </td>
        </tr>
        <tr>
            <td>Artilenamen:</td>
            <td><input type="text" name='artikelName'></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Preis:</td>
            <td><input type="number" step="0.01" name ='preis'></td>
        </tr>

  <br>


<!--
Beschreibung: <input type="text" name = 'beschreibung'><br>
Ist verfügbar: <input type="checkbox" name="verfuegbar" id=""><br>
Hersteller: <input type="text" name="hersteller" id=""><br>
-->
    </table>
<button type="submit" name="upload">upload</button>
</form>

<!--Form ende -->
    
</body>
</html>