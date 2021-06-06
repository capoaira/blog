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
	if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['ac'])) {
		$id = $_GET['id'];
		$ac = $_GET['ac'];
		
		$abfragen = mysqli_query($db, "SELECT * FROM unakiveusers WHERE id = '$id'");
		$user = mysqli_fetch_object($abfragen);
		if ($user !== false) {
			// Daten und users übertragen
			$email = $user->email;
			$benutzername = $user->benutzername;
			$passwort = $user->passwort;
			$created_at = $user->created_at;
			$abfragen = mysqli_query($db, "INSERT INTO users (email, benutzername, passwort, created_at, status) VALUES ('$email', '$benutzername', '$passwort', '$created_at', 'member')");
			echo '<p class="ausgabe">Die aktivierung war erfolgreich. <a href="login.php">Hier geht es zum Login</a></p>';
			//daten löschen aus
			$abfragen = mysqli_query($db, "DELETE FROM unakiveusers WHERE id = '$id'");
		} else {
			echo '<p class="fehler">Die aktivierung war nicht erfolgreich</p>';
		}
	}else {
		echo '<p class="fehler">Die aktivierung war nicht erfolgreich</p>';
	}
?>
            </article>
		</div>
		<?php include('../include/footer.php'); ?>
	</body>
</html>
