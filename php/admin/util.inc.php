<?PHP

function checkForAdmin()
{
    // Prüfe ob der Angemeldete User auch admin ist

    if (isset($_SESSION['isadmin'])) {
        if ($_SESSION['isadmin'])
            return TRUE;
    } else {
        return FALSE;
    }
}

function new_db_connect()
{

    $host = "localhost";        // IP Adresse oder domainname
    $user = "shop";            //  SQL benutzer
    $pass = '7_C@U!D7en(guxK3';         //  User Passwort
    $database = "webshop";      // name der Datenbank
    $connID = new mysqli($host, $user, $pass, $database);

    return $connID;
}

function checkLogin($userCHK, $passwordCHK)
{

    return true;
}

function passwordHash($eingabe)
{

    $hash = crypt($eingabe, '$6$rounds=5000$usesomesillystringforsalt$');
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

function getItemnr($durchlauf)
{
    // Zur ertellung des Grid in einer While schleife
    // Jeden durchlauf wird diese Funktion aufgerufen
    // und gibt ihm den namen des aktuellen Values für das grid zurück
    $item0 = "item-3";
    $item1 = "item-4";
    $item2 = "item-5";
    $item3 = "item-6";
    if ($durchlauf == 0) {
        return $item0;
    } elseif ($durchlauf == 1) {
        return $item1;
    } elseif ($durchlauf == 2) {
        return $item2;
    } elseif ($durchlauf == 3) {
        return $item3;
    }
}

?>