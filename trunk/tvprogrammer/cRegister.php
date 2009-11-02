<?php 
	include('functions.php');
	$name = $_GET['name'];
	$email = $_GET['email'];
	$username = $_GET['username'];
	$password = $_GET['password'];
	$password2 = $_GET['password2'];
	if(strcmp($password,$password2) == 0){
		addUser(utf8_encode($name), utf8_encode($email), utf8_encode($username),  md5($password));
		header('Location: http://' . $_SERVER['HTTP_HOST'] . '/verkefni/index.php?pid=0');
	}
	else{
		header('Location: http://' . $_SERVER['HTTP_HOST'] . '/verkefni/index.php?pid=1&fail=1&name=' . $name . '&email=' . $email . '&username=' . $username);
	}
?>