<?php
	include('include/db-connect.php');
	$isLogIn = isset($_SESSION['userid']);
	$isBlogger = $_SESSION['userstatus'] == 'blogger' || $_SESSION['userstatus'] == 'admin';
?>

<!doctype html>
<html lang="de">
	<head>
		<title>Mein Blog</title>
		<?php include('include/head.php'); ?>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="js/load_more.js"></script>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="capoaira (Jannes)">
	</head>
	<body>
		<?php include('include/header.php'); ?>
		<div id="content">
			<div id="add" style="display:none">
				<form action="php/addPost.php" method="POST"></form>
			</div>
			<a id="btn-loadMore" href="javascript:void(0)" onclick="loadMore(loaded, 5)">Mehr laden</a>
		</div>
		<aside>
			<span>Kontak:<br>
			<a href="mailto:capoaira@web.de">capoaira@web.de</a></span>
			<?php if ($isBlogger) { ?>
				<!--<br><br><a href="javascript:void(0)" class="btn" onclick="$('#add').toggle();">Eintrage Hinzufügen</a>-->
			<?php } ?>
		</aside>
		<?php include('include/footer.php'); ?>
	</body>
</html>
