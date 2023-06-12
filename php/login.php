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
</html>