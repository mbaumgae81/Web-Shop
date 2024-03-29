<?php
session_start();
include("../php/admin/util.inc.php");
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <?php
    if (isset($_POST["submit"])) {
        //  $fullName = $_POST["fullname"];
        $vorName = $_POST["vorname"];
        $nachName = $_POST["nachname"];
        $adresse = $_POST["adresse"];
        $telefon = $_POST["telefon"];
        $loginName = $_POST["loginname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["repeat_password"];

        $passwordHash = passwordHash($password);

        $errors = array();

        if (empty($vorName) or empty($email) or empty($password) or empty($passwordRepeat)) {
            array_push($errors, "Bitte Füllen Sie alle Felder aus.");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email ist nicht korrekt");
        }
        if (strlen($password) < 8) {
            array_push($errors, "Das PAsswort sollte midestens 8 Zeichen haben");
        }
        if ($password !== $passwordRepeat) {
            array_push($errors, "Passwörter stimmen nicht überein");
        }
        //require_once "database.php";

        $conn = new_db_connect();

        $sql = "SELECT * FROM User WHERE EmailAdresse = '$email'or LoginName = '$loginName'";
        $stmt = $conn->prepare($sql);                                                       // Prepared Statement

        // Prepared Statement

        $stmt->execute();
        $result = $stmt->get_result();

        //  $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);


        if ($rowCount > 0) {
            array_push($errors, "Email oder Loginname existiert bereits!");
        }
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {

            $sql = "INSERT INTO User (VorName, NachName, Adresse, Telefon, EmailAdresse, LoginName, PasswortHash) VALUES ( ?, ?, ?, ?, ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "sssssss", $vorName, $nachName, $adresse, $telefon, $email, $loginName, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Sie wurden erfolgreich Registriert.</div>";
            } else {
                die("Something went wrong");
            }
        }


    }
    ?>
    <form action="registration.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="vorname" placeholder="Vorname:" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="nachname" placeholder="Nachname:" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="adresse" placeholder="Adresse: " required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="telefon" placeholder="Telefon:" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="loginname" placeholder="Login Name:" required>
        </div>
        <div class="form-group">
            <input type="emamil" class="form-control" name="email" placeholder="Email:" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password:" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Register" name="submit">
        </div>
    </form>
    <div>
        <div><p>Schon Registriert<a href="login.php">Login Here</a></p></div>
    </div>
</div>
</body>
</html>