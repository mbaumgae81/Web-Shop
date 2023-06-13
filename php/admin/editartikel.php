<?php
include("adminheader.php");
include("util.inc.php");
if (!checkForAdmin()) {
    die(' Du kommst hier nicht rein !');
}
if (isset($_POST['zeile'])) {
    $conn = new_db_connect();

    $sql = "SELECT * FROM Artikel where artikelID = ?";                                           // Prepared Statement
    $stmt = $conn->prepare($sql);                                                       // Prepared Statement
    $stmt->bind_param("i", $_POST['zeile']);               // Prepared Statement

    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_array();
}
?>

<!-- Form für Datei Upload -->
<form action="func_upload.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td> Datei auswählen:</td>
            <td><input type="file" name="image" accept=".png,.jpg,.jpeg" value=""></td>
        </tr>
        <tr>
            <td>Artikelnamen:</td>
            <td><input type="text" name="artikelName" placeholder="Name des Artikels"
                       value=" <?PHP echo($row['name']); ?>"></td>
        </tr>
        <tr>
            <td>Beschreibung:</td>
            <td><input type="text" name="beschreibung" placeholder="Beschreibnung"
                       value=" <?PHP echo($row['beschreibung']); ?>"></td>
        </tr>
        <tr>
            <td>Preis:</td>
            <td><input type="number" step="0.01" name="preis" value=" <?PHP echo($row['preis']); ?>"></td>
        </tr>
        <tr>
            <td>Hersteller:</td>
            <td><input type="text" name="hersteller" placeholder="Hersteller" value=" <?PHP echo($row['preis']); ?>">
            </td>
        </tr>
        <tr>
            <td>Ist verfügbar:</td>
            <td><input type="checkbox" name="verfuegbar" value=" <?PHP echo($row['verfuegbar']); ?>"></td>
        </tr>
        <tr>
            <td>Kategorie</td>
            <td> <!-- Erstellen des Dropdownmenu -->
                <select name="kategorie" required>
                    <?PHP
                    $results = getKategorien();
                    while ($r = $results->fetch_array()) { ?>
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