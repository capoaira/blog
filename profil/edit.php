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
	if(isset($_SESSION['userid'])) {
?>
				
<?php
	} else {
		echo '<a href="login.php" title="Login">Melde dich an</a> um dein Profil zu bearbeiten.';
	}
?>
            </article>
		</div>
		<?php include('../include/footer.php'); ?>
	</body>
</html>
