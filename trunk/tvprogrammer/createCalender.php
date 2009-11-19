<?php 
	session_start();
	if(isset($_SESSION['access'])){
	include('functions.php');
	$cal = makeIcalender($_SESSION['calender']);
	$cal->returnCalendar();
	}
?>