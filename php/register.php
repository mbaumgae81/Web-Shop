<html lang="de">
	<?php
		session_start();
	?>
	

	<link rel="stylesheet" type="text/css" href="/test/stylesheet.css">
	

	<head>
		<meta charset="UTF-8">
	</head>

	<body>
		<form action="registrier.php" method="POST">
			<p class= "josef">Bitte tragen Sie Ihre Benutzerdaten ein.</p>
			<table>
				<tr>
					<td>
						<p>Benutzer:<br><input type="text" name="username"></p>
						<p>Passwort:<br><input type="password" name="passwort"></p>
					
	<?php
					$meldung = "";
					// verbinden mit der Datenbank (Server, User, Passwort, Datenbank)
					$con = new mysqli("localhost", "root", "Pa\$\$w0rd", "dbforum");
					if (isset($_POST['registrieren'])) {
						// abtrennen von führenden und nachhängenden Blanks
						$user = trim($_POST['username']);
						$passwort = trim($_POST['passwort']);
						if (!empty($user) && !empty($passwort)) {
							$sqlstmt = "select username from tblnutzer where lower(username) = '" . strtolower($user) . "';";
							// for debug
							//	echo $sqlstmt . "<br>";
							$results = $con->query($sqlstmt);
							// wenn Anzahl der Treffer = 0: neue Benutzerdaten dürfen eingefügt werden
							if ($results->num_rows == 0) {
								$sqlstmt = "insert into tblnutzer (username, datumreg, passwort, FK_art) VALUES ";
								$sqlstmt .= "('" . $_POST['username'] . "', '" . date("Y-m-d") . "', '" . $_POST['passwort'] . "', '" . $_POST['rolle'] . "');";
								// for debug
								//		echo $sqlstmt . "<br>";
								$con->query($sqlstmt);
								$meldung = "Der Benutzer " . $_POST['username'] . " wurde angelegt.<br>";
								
								$_SESSION['meldung'] = $meldung;
							//	header('location: login.php?meldung=' . $meldung);
								header('location: login.php');
								exit();
							} else {
								$meldung = "Der gewünschte Benutzername ist bereits vorhanden.<br>";
							}
						} else {
							$meldung = "Bitte alle Felder ausfüllen.<br>";
						}
					}
					$sqlstmt = "select art from tblrolle;";
					// formulierte Abfrage an Datenbank senden
					$results = $con->query($sqlstmt);		// Resultat ist ein ergebnis-Objekt
	?>
						<p>Rolle:<br><select name="rolle"></P>
	<?php
							// Die Ergebnis-Datensätze zeilenweise auslesen
							while ($datensatz = $results->fetch_assoc()) {		// assoziatives Array
								echo "<option>" . $datensatz['art'] . "</option>";
							}
							$con->close();
	?>
					</select></td>
				</tr>
			</table><br>
			<input type="submit" value="eintragen" name="registrieren">
		</form>
	<?php
		echo $meldung;
	?>
	</body>

</html>