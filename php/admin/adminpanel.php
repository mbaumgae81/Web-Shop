<<<<<<< Updated upstream
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
include("adminheader.php");
// Startseite des Administrations Panel
// Leere Seite aber alle Links zur Navigation befinden sich im adminheader
?>

<body>
Dies ist der Administrations Bereich.
hallo

</body>
</html>

=======
<?PHP
include("adminheader.php");
// Startseite des Administrations Panel
// Leere Seite aber alle Links zur Navigation bevinden sich im adminheader
?>

<body>
Dies ist der Administrations Bereich.
hallo

</body>
</html>




<?php



?>
>>>>>>> Stashed changes
