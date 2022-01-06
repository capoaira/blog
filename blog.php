<?php
	include('include/db-connect.php');
	$isLogIn = isset($_SESSION['userid']);
	$isBlogger = isset($_SESSION['userstatus']) && ($_SESSION['userstatus'] == 'blogger' || $_SESSION['userstatus'] == 'admin');
?>

<!doctype html>
<html lang="de">
	<head>
		<title>Titel</title>
		<?php include('include/head.php'); ?>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="capoaira (Jannes)">
	</head>
	<body>
		<?php include('include/header.php'); ?>
		<div id="content">
			<article>
                <?php
                    $id = $_GET['id'];
                    $abfrage = mysqli_query($db, "SELECT * FROM beitaege WHERE id = $id");
                    if ($row = mysqli_fetch_object($abfrage)) {
                        $title = $row->title;
                        $autor = $row->created_by;
                        $timestamp = strtotime($row->created_at);
                        $created_at_date = date("d.m.Y", $timestamp);
                        $created_at_time = date("H:i", $timestamp);
                        $content = $row->content;
                        $id = $row->id;
                        echo "
                            <h1>$title</h1>
                            <span><i>Verfasst von $autor am $created_at_date um $created_at_time</i></span>
                            <p>$content<p>";
                    }
                ?>
            </article>
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
