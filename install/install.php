<?php
include("../php/admin/util.inc.php");
if (isset($_POST['username'])){
    echo "Daten wurden übergeben <br>";
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $vorname = $_POST['Vorname'];
    $nachname = $_POST['Nachname'];
    $adresse = $_POST['Adresse'];
    $telefon = $_POST['Telefon'];
    $email = $_POST['Email'];
    $login = $_POST['LoginName'];
    $passwort = $_POST['Passwort'];
    $passwortRe = $_POST['PasswortRe'];
    $isadmin = 1;
    if ($passwort != $passwortRe) {

        die("Passwörter stimmen nicht überein!");
    }

    $passHash = passwordHash($passwort);    // erzeuge passwort hash

    $conn = new mysqli("localhost", $user, $pass);
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: " . $conn->connect_errno;
        echo "<br/>Error: " . $conn->connect_error;
    }
    //$sql = file_get_contents( '../sql/db.sql');
    //$conn->multi_query($sql);

    $filename = '../sql/db.sql';
    $runtimes = 0;
    $op_data = '';
    $lines = file($filename);
    foreach ($lines as $line) {
//        echo "<br>".$runtimes;
//        $runtimes++;
        if (substr($line, 0, 2) == '--' || $line == '')//This IF Remove Comment Inside SQL FILE
        {
            continue;
        }
        $op_data .= $line;
        if (substr(trim($line), -1, 1) == ';')//Breack Line Upto ';' NEW QUERY
        {
            $conn->query($op_data);
            $op_data = '';
        }
    }
    echo "<br> Table Created Inside  the database . . . <br>";
    $connb = new mysqli("localhost", $user, $pass, 'webshop');
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: " . $connb->connect_errno;
        echo "<br/>Error: " . $connb->connect_error;
    }
    // Admin User nach vorgaben erstellen
    $admin = "INSERT INTO `User`( `VorName`, `NachName`, `Adresse`, `Telefon`, `EmailAdresse`, `LoginName`, `PasswortHash`, `istAdmin`) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $connb->prepare($admin);
    $stmt->bind_param("sssssssi", $vorname, $nachname, $adresse, $telefon, $email, $login, $passHash, $isadmin);               // Prepared Statement
    $stmt->execute();
//
//    $sql = "CREATE USER 'shop'@'localhost' IDENTIFIED VIA mysql_native_password USING '7_C@U!D7en(guxK3';GRANT USAGE ON *.* TO 'shop'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `webshop`.* TO 'shop'@'localhost';";
//    $stmt = $connb->prepare($sql);
//    $stmt->execute();


} else {
?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="install.php" method="post">
    <h1>Installation Datenbank admin user der SQL zum erstellen</h1>
    <p>SQL Username</p><input type="text" name="username" required>
    <p>SQL Pssswort</p><input type="password" name="password" required>
    <br>
    <br>
    <h1>Benutzer für den Admin bereich anlegen</h1>
    <input type="text" name="Vorname" value="" placeholder="Vorname" required>
    <input type="text" name="Nachname" value="" placeholder="Nachname" required>
    <input type="text" name="Adresse" value="" placeholder="Adresse" required>
    <input type="tel" name="Telefon" value="" placeholder="telefon" required>
    <input type="email" name="Email" value="" placeholder="email" required>
    <input type="text" name="LoginName" value="admin" placeholder="" required>
    <input type="text" name="Passwort" value="" placeholder="Passwort" required>
    <input type="text" name="PasswortRe" value="" placeholder="Passwort wiederholen" required>


    <input type="submit" value="erstellen">
</form>


</body>

<?PHP
}
?>
</html>