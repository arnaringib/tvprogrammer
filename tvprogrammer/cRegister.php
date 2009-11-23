<?php 
	include('functions.php');
	$name = $_GET['name'];
	$email = $_GET['email'];
	$username = $_GET['username'];
	$password = $_GET['password'];
	$password2 = $_GET['password2'];
	if(strcmp($password,$password2) == 0){
		if(!chkLogin($username,$password)){
			addUser($name, $email, $username,  $password);
			header('Location: http://' . $_SERVER['HTTP_HOST'] . '/~aib3/tvcalendar/index.php?pageid=0');
		}
		else{
			header('Location: http://' . $_SERVER['HTTP_HOST'] . '/~aib3/tvcalendar/index.php?pageid=1&fail=2&name=' . $name . '&email=' . $email . '&username=' . $username);
		}
	}
	else{
		header('Location: http://' . $_SERVER['HTTP_HOST'] . '/~aib3/tvcalendar/index.php?pageid=1&fail=1&name=' . $name . '&email=' . $email . '&username=' . $username);
	}
?>