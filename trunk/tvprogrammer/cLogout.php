<?php 
	session_destroy();
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/tvprogrammer/index.php?pageid=0');
?>