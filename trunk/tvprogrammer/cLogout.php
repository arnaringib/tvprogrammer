<?php 
	unset($_SESSION['access']);
	session_destroy();
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/verkefni/index.php?pageid=0');
?>