<?php
	include('db-connect.php');
	
	$email = $_GET['email'];
	$verfügbar = true;
	
	//aktivierte Benutzer
	$abfragen = mysqli_query($db, "SELECT id FROM users WHERE email = '$email'");
	if ($abfragen && $row=mysqli_fetch_object($abfragen)) $verfügbar = false;
	//unaktivierte user
	$abfragen = mysqli_query($db, "SELECT id FROM unakiveusers WHERE email = '$email'");
	if ($abfragen && $row=mysqli_fetch_object($abfragen)) $verfügbar = false;
	
	echo ($verfügbar) ? 'true' : 'false';
?>