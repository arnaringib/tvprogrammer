<?php 
	$fail = false;
	if(isset($_GET['fail'])){
		if(strcmp($_GET['fail'],"1") == 0 || strcmp($_GET['fail'],"2") == 0){
			$fail = true;
		}
	}
?>
<div class="register">
<table align="center">
<form action="cRegister.php" method="get">
<tr>
	<td>Nafn:</td><td><input type="text" name="name" <?php if($fail) echo 'value=' . $_GET['name']; ?> /></td><td></td>
</tr>
<tr>
	<td>E-mail:</td><td><input type="text" name="email" <?php if($fail) echo 'value=' . $_GET['email']; ?> /></td><td></td>
</tr>
<tr>
	<td>Notendanafn:</td><td><input type="text" name="username" <?php if($fail) echo 'value=' . $_GET['username']; ?> /></td><td><?php if($fail && strcmp($_GET['fail'],"2") == 0) echo 'Notendanafni&eth; er þegar til, veldu nýtt.' ?></td>
</tr>
<tr>
	<td>Lykilor&eth;:</td><td><input type="password"  name="password" /></td><td><?php if($fail && strcmp($_GET['fail'],"1") == 0) echo 'Lykilor&eth;in voru ekki eins reyndu aftur.' ?></td>
</tr>
<tr>
	<td>Lykilor&eth; aftur:</td><td><input type="password"  name="password2" /></td><td></td>
</tr>
<tr>
	<td colspan="3"><input type="submit" value="Skrá sig" /></td>
</tr>
</form>
</table>
</div>