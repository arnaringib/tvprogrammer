<?php
	session_start();
	include('functions.php');
	removeFromCalender($_SESSION['calender'], $_GET['id']);
?>