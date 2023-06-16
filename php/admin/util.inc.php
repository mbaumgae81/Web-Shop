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

// Stellt DB verbindung her
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

    $conn = new_db_connect();
    $sql = "SELECT * FROM User WHERE LoginName = ? and PasswortHash = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $userCHK, $passwordCHK);
    $stmt->execute();
    $result =$stmt->get_result();
    return $result;
}

// Erzeuge einen Hash anhand der eingabe
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

function getAnzahlergebnisse($sql, $repp)
{ // übergebe select und bekomme die benötigte Seitenzahl zurüclgeliefert
    $conn = new_db_connect();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $total_records = $result->num_rows;
    $total_pages = ceil($total_records / $repp);
    $conn->close();
    return $total_pages;
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

function getArtikelwith($sql, $start, $res)
{
    $conn = new_db_connect();
    $stmt = $conn->prepare($sql);                                                       // Prepared Statement
    $stmt->bind_param("dd", $start, $res);               // Prepared Statement
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die('Could not query:' . $conn->error);                                      // Wenn es keine ergbnis gibt wird Fehler ausgeggeben
    }

    return $result;
}

function getArtikelSearch($sql, $start, $res,$suche)
{
    $conn = new_db_connect();

    $param = "%{$suche}%";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdd", $param, $start_from, $res_per_page);
    $stmt->execute();
    $result = $stmt->get_result();
    echo $result->num_rows . "<br>";
    echo "Suchergebnisse für " . $suche;
    return $result;
}


?>