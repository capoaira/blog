<?php
	include('../include/db-connect.php');
?>

<!doctype html>
<html lang="de">
	<head>
		<title>Titel</title>
        <?php include('../include/head.php'); ?>
        <script src="/blog/js/register.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="capoaira (Jannes)">
	</head>
	<body>
		<?php include('../include/header.php'); ?>
		<div id="content" style="margin-right:0;">
            <article style="text-align:center;">
<?php
if(!isset($_SESSION['userid'])) {
    $zeigeFormular = true;
	$error = false;
    $email = '';
    $nutzername = (isset($_GET['bn'])) ? $_GET['bn'] : '';
	if (isset($_POST['submited']))  { // wenn schon abgesendet wurde
		$email = $_POST['email'];
		$nutzername = $_POST['benutzername'];
		$pw = $_POST['passwort'];
        $pww = $_POST['passwortWdhl'];
        $error = false;
		// prüft ob alles Korrekt eingegeben wurde
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {echo 'Keine gültige E-Mail\n'; $error = true;}
		if (strlen($nutzername) > 15) {echo 'Nutzername ist zu lang\n'; $error = true;}
		if (strlen($nutzername) < 5) {echo 'Nutzername ist zu kurz\n'; $error = true;}
		if (strlen($pw) < 6) {echo 'Das Passwort ist zu kurz\n'; $error = true;}
		if ($nutzername == $pw) {echo 'Das Passwort darf nicht gleich dem Nutzernamen sein\n'; $error = true;}
		if ($pww != $pw) {echo 'Die Passwort Wiederholung ist nicht gleich dem Passwort\n'; $error = true;}
		// prüft ob die E-Mail schon vergebn ist
		// aktivierte user
		$abfragen = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");
		if ($abfragen && $row=mysqli_fetch_object($abfragen)) {echo 'Die E-Mail ist schon genutzt\n'; $error = true;}
		// unaktivierte user
		$abfragen = mysqli_query($db, "SELECT * FROM unakiveusers WHERE email = '$email'");
		if ($abfragen && $row=mysqli_fetch_object($abfragen)) {echo 'Die E-Mail ist schon genutzt\n'; $error = true;}
		// prüft ob der Benutzername bereits vergeben ist
		// aktivierte Benutzer
		$abfragen = mysqli_query($db, "SELECT * FROM users WHERE benutzername = '$nutzername'");
		if ($abfragen && $row=mysqli_fetch_object($abfragen)) {echo 'Der Nutzername ist bereits vergeben\n'; $error = true;}
		// unaktivierte user
		$abfragen = mysqli_query($db, "SELECT * FROM unakiveusers WHERE benutzername = '$nutzername'");
		if ($abfragen && $row=mysqli_fetch_object($abfragen)) {echo 'Der Nutzername ist bereits vergeben\n'; $error = true;}
		// für den Fehlerfall werden wie eingaben gespeichert und im Formular belassen.
		$zeigeFormular = $error;
	}
	if ($zeigeFormular)	{ // Start und Fehlerseite
		if ($error) {
            echo '<p class="fehler"><span style="font-weight:bold;">Leider sind Fehler in den Eingaben</span></p>';
            echo "<script>$(document).ready(function(){checkEMail('$email');checkUserName('$nutzername');});</script>";
        }
?>
                <form action="register.php" method="post">
                    <table>
                        <tr>
                            <td>E-Mail:</td>
                            <td><input type="email" maxlength="250" <?php echo 'value="' . $email . '"'; ?> name="email" onblur="checkEMail(this.value);" onkeyup="checkEMail(this.value);">*</td>
                        </tr>
                        <tr id="emailError"><td colspan="2"><span class="fehler"></span></td></tr>
                        <tr>
                            <td>Benutzername:</td>
                            <td><input type="text" <?php echo 'value="' . $nutzername . '"'; ?> maxlength="15" name="benutzername" onblur="checkUserName(this.value);" onkeyup="checkUserName(this.value);">*</td>
                        </tr>
                        <tr id="userNameError"><td colspan="2"><span class="fehler"></span></td></tr>
                        <tr>
                            <td>Passwort:</td>
                            <td><input type="password" maxlength="250" name="passwort" onblur="checkPassword(this.value);" onkeyup="checkPassword(this.value);">*</td>
                        </tr>
                        <tr id="passwortError"><td colspan="2"><span class="fehler"></span></td></tr>
                        <tr>
                            <td>Passwort wiederholen:</td>
                            <td><input type="password" maxlength="250" name="passwortWdhl" onblur="checkDoublePasswort(this.value);" onkeyup="checkDoublePasswort(this.value);">*</td>
                        </tr>
                        <tr id="passwortErrorWdhl"><td colspan="2"><span class="fehler"></span></td></tr>
                        <tr>
                            <td colspan="2">*Pflichtangabe</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center;"><input type="submit" id="submit" value="Registrieren" name="submited" disabled></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-size:12px;text-align:center;">Du hast bereits ein Benutzerkonto? <a href="login.php">Hier geht's zum Login</a></td>
                        </tr>
                    </table>
                </form>
<?php
    } else { // erfolgreich registriert
        // Passwort Hashen
        $passwortHash = password_hash($pw, PASSWORD_DEFAULT);
        // Daten Speichern
        $abc = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $aktivierungscode = '';
        for ($i=0; $i<250; $i++) {
            $aktivierungscode .= $abc[rand(0,strlen($abc)-1)];
        }
        $eintrage = mysqli_query($db, "INSERT INTO unakiveusers (email, benutzername, passwort, pruefcode) VALUES ('$email', '$nutzername', '$passwortHash', '$aktivierungscode')");
        $abfragen = mysqli_query($db, "SELECT id FROM unakiveusers WHERE benutzername = '$nutzername'");
        $neue_id = mysqli_fetch_object($abfragen)->id;
        if ($neue_id != 0) {
            echo '<p class="ausgabe">Dein Benutzerkonto wurde erstellt!</p>';
            echo '<p><a href="activate.php?ac=' . $aktivierungscode . '&id=' . $neue_id .'">Dein Konto aktivieren</a></p>';
        } else {
            echo '<p class="fehler"><span style="font-weight:bold;">Leider ist ein Fehler aufgetreten</span></p>';
        }
    }
} else {
    echo 'Du hast dich bereits registriert und bist eingeloggt.';
}
?>
            </article>
		</div>
		<?php include('../include/footer.php'); ?>
	</body>
</html>
