<?php
	session_start();
	include('functions.php');
	//$date = date('d');
	$date = $_GET['date'];
	if (strlen($_GET['date']!=0))
	{ 
	
	}
	
	for($i = 0; $i != 7; $i++){
		getRuv($date);
	}
?>
