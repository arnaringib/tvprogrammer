<table>
<form action="cLogin.php" method="get">
<tr>
	<td>Notendanafn:</td><td><input type="text" name="username" value="<?php echo $_GET['username']; ?>"/></td>
</tr>
<tr>
	<td>Lykilor&eth;:</td><td><input type="password" name="password" /></td>
</tr>
<tr>
	<td><input type="submit" value="Skrá inn" /></td><td><?php if(strcmp($_GET['fail'],"1") == 0) echo 'Rangt notendanafn e&eth;a lykilor&eth;, reyndu aftur.'; ?></td>
</tr>
<tr>
	<td colspan="2">Ekki skr&aacute;&eth;ur notandi? <a href="<?php $_SERVER['PHP_SELF']; ?>?pageid=1">Skr&aacute;&eth;u &thorn;ig h&eacute;rna.</a></td>
</tr>
</form>
</table>
