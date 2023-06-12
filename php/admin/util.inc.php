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

function getItemnr($durchlauf){
    $item0 ="item-3";
    $item1 ="item-4";
    $item2 ="item-5";
    $item3 ="item-6";
    if ($durchlauf == 0){
        return $item0;
    } elseif ( $durchlauf ==1){
        return $item1;
    } elseif ($durchlauf == 2){
        return $item2;
    }elseif ($durchlauf == 3){
        return $item3;
    }
}

?>