<?PHP
require("config.php");
// $database, $user, $pass
 function new_db_connect(){
  
    $user = "shop";            //  SQL benutzer
    $pass = 'shop';         //  User Passwort
    $database = "webshop";      // name der Datenbank
    $host = "127.0.0.1";
    $connID = new mysqli($host, $user, $pass, $database);

    return $connID; 
}



?>