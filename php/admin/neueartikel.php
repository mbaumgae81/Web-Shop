<?php
include("adminheader.php");
include("util.inc.php");
?>

<!-- Form für Datei Upload -->
<form action="func_upload.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td> Datei auswählen:</td>
            <td><input type="file" name="image" accept=".png,.jpg,.jpeg" required></td>
        </tr>
        <tr>
            <td>Artikelnamen:</td>
            <td><input type="text" name="artikelName" placeholder="Name des Artikels" required></td>
        </tr>
        <tr>
            <td>Beschreibung:</td>
            <td><input type="text" name="beschreibung" placeholder="Beschreibnung" required></td>
        </tr>
        <tr>
            <td>Preis:</td>
            <td><input type="number" step="0.01" name="preis" required></td>
        </tr>
        <tr>
            <td>Hersteller:</td>
            <td><input type="text" name="hersteller" placeholder="Hersteller" required></td>
        </tr>
        <tr>
            <td>Ist verfügbar:</td>
            <td><input type="checkbox" name="verfuegbar" value="1" checked></td>
        </tr>
        <tr>
            <td>Ist im Angebot:</td>
            S
            <td><input type="checkbox" name="angebot" value="1" checked></td>
        </tr>
        <tr>
            <td>Kategorie</td>
            <td> <!-- Erstellen des Dropdownmenu -->
                <select name="kategorie" required>
                    <?PHP
                    $results = getKategorien();
                    while ($r = $results->fetch_array()) {
                        echo $r['kategorieID'];
                        ?>
                        <option value="<?php echo $r['kategorieID']; ?>">  <?php echo $r['bezeichnung']; ?></option>
                        <?PHP
                    }
                    ?>
                </select>
                <!-- Drop down erstellt-->
            </td>
        </tr>

    </table>
    <button type="submit" name="upload">upload</button>
</form>
</body>
</html>