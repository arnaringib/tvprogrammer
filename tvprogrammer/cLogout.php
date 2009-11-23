<?php 
	session_start();
	unset($_SESSION['access']);
	session_destroy();
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/~aib3/tvcalendar/index.php?pageid=0');
?>