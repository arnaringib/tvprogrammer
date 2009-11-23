<?php 
	include('functions.php');
	session_start();
	$username = $_GET['username'];
	$password = $_GET['password'];
	if(chkLogin($username,$password)){
		$_SESSION['username'] = $username;
		$_SESSION['name'] = getName($username);
		$_SESSION['calender'] = getCalender($username);
		$_SESSION['access'] = "1";
		header('Location: http://' . $_SERVER['HTTP_HOST'] . '/~aib3/tvcalendar/index.php?pageid=2');
	}
	else{
		header('Location: http://' . $_SERVER['HTTP_HOST'] . '/~aib3/tvcalendar/index.php?pageid=0&fail=1&username=' . $username);
	}
?>