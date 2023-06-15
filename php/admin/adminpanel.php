<?PHP
session_start();

include ("util.inc.php");
if (!checkForAdmin()) {
    die(' Du kommst hier nicht rein !');
}
//
//if (isset($_SESSION['isadmin'])) {
//    echo $_SESSION['isadmin'];
//} else {
//    echo " Isadmin is not set ";
//    die(" Bitte anmelden");
//}

// Startseite des Administrations Panel
// Leere Seite aber alle Links zur Navigation befinden sich im adminheader
?>
<!DOCTYPE html>
<html lang="de">
<!-- Der admin Header Das Grund gerüst das auf jeder Seite im Admin bereich geladen wird.
-->
<head>
    
    <link rel="stylesheet" href="../../css/index.css">
   <!-- <link href="../../css/adminpanel.css" rel="stylesheet" type="text/css" media="screen" />-->
    <title>Document</title>
</head>

<body>
    <header>
    <h1>Sitzathlet Web-Shop</h1>
        <nav class="navi">
            <li>
                <a href="neueartikel.php"> Artikel anlegen</a>
            </li>
            <li>
                <a href="abfragealle.php">Artikel anzeigen / Löschen </a>
            </li>

            <li>
                <a href="neuekategorie.php" >Kategorien erstellen</a>
            </li>
            <li>
                <a href="../../index.php">Zum Shop</a>
            </li>
        </nav>
        <br>
        <br>
    
    </header>
    <h1 >Dies ist der Administrations Bereich. hallo</h1>
</body>
</html>

