<?php 
	$channel = $_GET['channel'];
	switch($channel){
		case 0:
			include('sRuv.php');
			break;
		case 1:	
			include('sStod2.php');
			break;
		case 2:
			include('sSkjarEinn.php');
			break;
	}
?>