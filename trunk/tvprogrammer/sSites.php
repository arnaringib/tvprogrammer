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
		case 2:
			if(isset($_SESSION['access']))
				if(strcmp($_SESSION['access'], "1") == 0)
					include('sMain.php');
			break;
		case 3:
			include('cLogout.php');
			break;
		case 4:
			if(isset($_SESSION['access']))
				if(strcmp($_SESSION['access'], "1") == 0)
					include('sUserManagement.php');
			break;
		case 5:
			if(isset($_SESSION['access']))
				if(strcmp($_SESSION['access'], "1") == 0)
					include('sChannels.php');
			break;
		case 6:
			if(isset($_SESSION['access']))
				if(strcmp($_SESSION['access'], "1") == 0)
					include('sChannelsDay.php');
			break;
		default:
			break;
	}
?>