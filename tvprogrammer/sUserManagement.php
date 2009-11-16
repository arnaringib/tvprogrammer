<?php $data = getUserData($_SESSION['username']);?>
<form action="cUserManagement.php" method="get">
<table>
	<tr>
		<td>Nafn:</td><td><input type="text" name="newname" value="<?php echo $data[0]; ?>"></td><td></td>
	</tr>
	<tr>
		<td>E-mail:</td><td><input type="type" name="newemail" value="<?php echo $data[1];?>"></td><td></td>
	</tr>
	<tr>
		<td>Lykilor&eth;:</td><td><input type="password" name="newpassword1" value=""></td><td>Ef þú vilt ekki breyta um lykilorð ekki skrifa neitt í reitinn.</td>
	</tr>
	<tr>
		<td>Lykilor&eth; aftur:</td><td><input type="password" name="newpassword2" value=""></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="action" value="Breyta">&nbsp;<input type="submit" name="action" value="Hætta við"></td>
	</tr>
</table>