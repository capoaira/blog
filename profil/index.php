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
		$own = isset($_GET['userid']);
?>
				<div style="display:flex;">
					<div class="pb"><img src="" title=""/></div>
					<div class="content"></div>
					<div class="edit"><img src="" title="bearbeiten"/></div>
				</div>
<?php
	} else {
		echo '<a href="login.php" title="Login">Melde dich an</a> um das Profil anzugucken.';
	}
?>
            </article>
		</div>
		<?php include('../include/footer.php'); ?>
	</body>
</html>
