<?php 
	if(!isset($_GET['pageid'])){
		$pageid = 0;
	}
	else{
		$pageid = $_GET['pageid'];
	}
	switch($pageid){
		case 0:
			include('sLogin.php');
			break;
		case 1:	
			include('sRegister.php');
			break;
		default:
			break;
	}
?>