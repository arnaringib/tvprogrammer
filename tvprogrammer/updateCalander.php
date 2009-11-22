<?php 
	session_start();
	include('functions.php');

	addToCalender($_GET['date'], $_GET['id'], $_SESSION['calender'], $_GET['cal']);

?>