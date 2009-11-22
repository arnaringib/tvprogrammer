<?php 
session_start();
include('functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>TV-programmer</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>

<body>
<script type="text/javascript" src="javascript/channel.js"></script>
<div class="container">
	<?php if(isset($_SESSION['access'])) if(strcmp($_SESSION['access'],"1") == 0){ ?>
	<div class="user"><?php if(isset($_SESSION['access'])) if(strcmp($_SESSION['access'],"1") == 0)include('sUser.php');?></div>
	<?php } ?>
	<div class="header">
		<div class="logo"><a href="#"><img src="img/logo.png"/></a></div>
		<div class="links"><?php if(isset($_SESSION['access'])) if(strcmp($_SESSION['access'],"1") == 0)include('sLinks.php'); ?></div>
	</div>
	<div class="content">
		<?php include('sSites.php'); ?>
	</div>
	<div class="footer">
	</div>
</div>
</body>
</html>
