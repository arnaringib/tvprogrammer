<?php 
	include('functions.php');
	session_start();
	if(strcmp($_GET['action'],"Breyta") == 0){
		userChange($_SESSION['username'],$_GET['newname'],$_GET['newemail']);
		$_SESSION['name'] = $_GET['newname'];
		if(strlen($_GET['newpassword1']) > 0){
			if(strcmp($_GET['newpassword1'],$_GET['newpassword2']) == 0){
				userChangePassword($_SESSION['username'],$_GET['newpassword1']);
			}
		}
	}
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/verkefni/index.php?pageid=2');
?>