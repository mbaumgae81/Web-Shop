<?php
session_start();
include("../php/admin/util.inc.php");
if (isset($_SESSION["user"])) {

    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <?php
    if (isset($_GET['order'])){
        echo "<div class='alert alert-danger'>Bitte anmelden vor der Bestellung!</div>";
    }
    if (isset($_POST["login"])) {
        $login = $_POST["loginname"];
        $passwordhash = passwordHash($_POST["password"]); // Erzeugt einen hash aus dem PAsswort
        $result = checkLogin($login, $passwordhash);
        $r = $result->fetch_array();
        $rowCount = mysqli_num_rows($result);

        if ($rowCount > 0) {
            $_SESSION["user"] = "yes";                  // Daten zum user werden in der Session Gespeichert
            $_SESSION["username]"] = $login;
            if ($r['istAdmin'] == 1) {
                $_SESSION['isadmin'] = TRUE;
            } else {
                $_SESSION['isadmin'] = FALSE;
            }
            $_SESSION['userID'] = $r['userID'];
            header("Location: ../index.php");
            die();
        } else {

            echo "<div class='alert alert-danger'>Anmeldedaten stimmen nicht !</div>";
        }
    }

    ?>
    <form action="login.php" method="post">
        <div class="form-group">
            <input type="text" placeholder="Login Namen Eingeben:" name="loginname" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Passwort Eingeben:" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
    </form>
    <div><p>Noch nicht registriert ?<a href="registration.php">Register Here</a></p></div>
</div>
</body>
</html>