<?php
include("adminheader.php");
?>

<!-- Form für Datei Upload -->
<form action="upload.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td> Datei auswählen:</td>
            <td><input type="file" name="image" accept=".png,.jpg,.jpeg" > </td>
        </tr>
        <tr>
            <td>Artikelnamen:</td>
            <td><input type="text" name="artikelName" placeholder="Name des Artikels" ></td>
        </tr>
        <tr>
            <td>Beschreibung: </td>
            <td><input type="text" name = "beschreibung" placeholder="Beschreibnung"></td>
        </tr>
        <tr>
            <td>Preis:</td>
            <td><input type="number" step="0.01" name ="preis"></td>
        </tr>
        <tr>
            <td>Hersteller: </td>
            <td><input type="text" name="hersteller" placeholder="Hersteller" id=""></td>
        </tr>
        <tr>
            <td>Ist verfügbar: </td>
            <td><input type="checkbox" name="verfuegbar" value="1"> </td>
        </tr>



<!--
<br>
Ist verfügbar: <input type="checkbox" name="verfuegbar" id=""><br>

-->
    </table>
<button type="submit" name="upload">upload</button>
</form>

<!--Form ende -->
    
</body>
</html>