<<<<<<< Updated upstream
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
    if (isset($_POST["login"])) {
        $login = $_POST["loginname"];
        $passwordhash = passwordHash($_POST["password"]); // Erzeugt einen hash aus dem PAsswort


        $conn = new_db_connect();
        $sql = "SELECT * FROM User WHERE LoginName = ? and PasswortHash = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $login, $passwordhash);
        $stmt->execute();
        $result = $stmt->get_result();
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
            <input type="text" placeholder="Enter Login name:" name="loginname" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Enter Password:" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
    </form>
    <div><p>Noch nicht Registriert ?<a href="registration.php">Register Here</a></p></div>
</div>
</body>
=======
<html lang="de">
<?php
	session_start();
?>
 <link rel="stylesheet" type="text/css" href="/test/stylesheet.css">

	<head>
		<meta charset="UTF-8">
	</head>

	<body>
	<form action="login.php" method="POST">
<?php
	if (isset($_SESSION['meldung'])) {
		echo $_SESSION['meldung'] . "<br>";
	}


?>
		<p class = "anmelden">Bitte melden sie sich an.</p>
		<p>Benutzer:<br><input type="name" name="username"></p>
		<p>Passwort:<br><input type="password" name="passwort"></p>
		<input type="submit" name="submit" value="Login">
		<input type="submit" value="Registrieren" formaction="registrier.php">
	</form>
<?php
	if (isset($_POST['submit'])) {
		$user = trim($_POST['username']);
		$passwort = trim($_POST['passwort']);
		if (!empty($user) && !empty($passwort)) {
			$con = new mysqli("localhost", "root", "Pa\$\$w0rd", "dbforum");
			$sqlstmt = "select username, passwort from tblnutzer where username = '" . $_POST['username'] . "' and passwort = '" . $_POST['passwort'] . "';";
			$results = $con->query($sqlstmt);
			if ($results->num_rows == 1) {
				$_SESSION['user'] = $user;
				header("location: dummy_portal.php");
				exit();
			}
		} else {
			echo "Anmelde-Daten nicht korrekt.<br>";
		}
	}
?>
	</body>
>>>>>>> Stashed changes
</html>