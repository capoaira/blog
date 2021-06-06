<?php
	include('db-connect.php');
	
	$input_user = $_GET['name'];
	$verfügbar = true;
	
	//aktivierte Benutzer
	$abfragen = mysqli_query($db, "SELECT id FROM users WHERE benutzername = '$input_user'");
	if ($abfragen && $row=mysqli_fetch_object($abfragen)) $verfügbar = false;
	//unaktivierte user
	$abfragen = mysqli_query($db, "SELECT id FROM unakiveusers WHERE benutzername = '$input_user'");
	if ($abfragen && $row=mysqli_fetch_object($abfragen)) $verfügbar = false;
	
	echo ($verfügbar) ? 'true' : 'false';
?>