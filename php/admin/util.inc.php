<?PHP
require("config.php");
// $database, $user, $pass
function new_db_connect()
{

    $user = "shop";            //  SQL benutzer
    $pass = 'shop';         //  User Passwort
    $database = "webshop";      // name der Datenbank
    $host = "127.0.0.1";
    $connID = new mysqli($host, $user, $pass, $database);

    return $connID;
}

function checkLogin($userCHK, $passwordCHK)
{

    return true;
}

function passwordHash($eingabe)
{   
    //echo $eingabe;
    $hash = crypt($eingabe,'$6$rounds=5000$usesomesillystringforsalt$');
    return $hash;
}

function getKategorien()
{
    $conn = new_db_connect();
    $kategorieabfrage = " SELECT * FROM  webshop.Kategorie";
    $stmt = $conn->prepare($kategorieabfrage);
    $stmt->execute();
    $results = $stmt->get_result();
    $conn->close();

    return $results;
}

?>