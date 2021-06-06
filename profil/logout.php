<?php
	include('../include/db-connect.php');
	session_destroy();
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
	echo '<p class="ausgabe">Du hast dich erflogreich ausgeloggt</p><p><a href="login.php">Login</a></p>';
?>
            </article>
		</div>
		<?php include('../include/footer.php'); ?>
	</body>
</html>
