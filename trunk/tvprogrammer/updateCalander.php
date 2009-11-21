<?php 
	session_start();
	include('functions.php');
	addToCalender($_GET['date'], $_GET['id'], $_SESSION['calender'], $_GET['cal']);
/*	for($i = 0; $i != 7; $i++){
		echo date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+$i, date('Y')));
		echo $_GET['id'];
		//addToCalender($_GET['date'],$_GET[date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+$i, date('Y')))],$_SESSION['calender'],$_GET['cal']);
	}*/
?>