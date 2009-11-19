<?php
	session_start();
	include('functions.php');
	removeOldFromCalender($_SESSION['calender']);
?>