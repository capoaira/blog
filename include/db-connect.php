<?php
	session_start();
	$db = mysqli_connect("localhost", "root", "", "blog");
	if(!$db) {
		exit("Verbindungsfehler: " . mysqli_connect_error());
	}
?>
