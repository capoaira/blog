<?php
	include('../include/db-connect.php');
?>

<!doctype html>
<html lang="de">
	<head>
		<title>Titel</title>
		<?php include('../include/head.php'); ?>
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
	$benutzername = ""; //value für den Benuzternamen
	if (isset($_POST['submited']))  { // wenn schon abgesendet wurde
		$benutzername = $_POST['benutzername'];
		$passwort = $_POST['passwort'];
		
		$abfragen = mysqli_query($db, "SELECT * FROM users WHERE benutzername = '$benutzername'");
		$user = mysqli_fetch_object($abfragen);
		
		// Überprüfung des Passworts
		if ($user !== false && password_verify($passwort, $user->passwort)) {
			$_SESSION['userid'] = $user->id;
			$_SESSION['userstatus'] = $user->status;
			$id = $_SESSION['userid'];
			$zeigeFormular = false;			
		} else {
			echo '<p class="fehler">Login nicht Erfolgreich. ';
			if ($user === false) {
				echo 'Der eingegebene Benutzername ist nicht vergeben. <a href="register.php?bn=' . $benutzername . '">Registrieren?</a></p>';
			} else {
				echo 'Das eingegeben Passwort ist Falsch</p>';
			}
		}
	}
	if ($zeigeFormular) {
?>
			<form action="login.php" method="post">
				<table>
					<tr>
						<td>Benutzername: </td>
						<td><input type="text" <?php echo "value='$benutzername'";?> maxlength="15" name="benutzername"></td>
					</tr>
					<tr>
						<td>Passwort: </td>
						<td><input type="password" maxlength="250" name="passwort"></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;"><input type="submit" value="Login" name="submited"></td>
					</tr>
					<tr>
						<td colspan="2" style="font-size:12px;text-align:center;">Noch kein Benutzerkonto? <a href="register.php">Hier kannst du dich registrieren</a></td>
					</tr>
				</table>
			</form>
<?php
	} else {
		echo '<p class="ausgabe">Der Login war erfolgreich!</p>';
		echo '<p>Sollte die automatische Weiterleitung innerhalb der nächsten 3 Sekunden nicht funktionieren, klicken sie <a href="index.php">hier</a></p>';
		$returnURL = (isset($_GET['returnURL'])) ? $_GET['returnURL'] : 'index.php';
		echo "<script>window.setTimeout(function() {document.location='$returnURL'}, 2000)</script>"; 
	}
} else {
	echo 'Du bist bereits eingeloggt.';
}
?>
            </article>
		</div>
		<?php include('../include/footer.php'); ?>
	</body>
</html>
