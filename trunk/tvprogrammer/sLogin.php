<table>
<form action="cLogin.php" method="get">
<tr>
	<td>Notendanafn:</td><td><input type="text" name="username" /></td>
</tr>
<tr>
	<td>Lykilor&eth;:</td><td><input type="password" name="password" /></td>
</tr>
<tr>
	<td><input type="submit" value="Skrá inn" /></td><td><div class="wrong" style="visibility:hidden">Rangt notendanafn e&eth;a lykilor&eth;, reyndu aftur.</div></td>
</tr>
<tr>
	<td colspan="2">Ekki skr&aacute;&eth;ur notandi? <a href="<?php $_SERVER['PHP_SELF']; ?>?pageid=1">Skr&aacute;&eth;u &thorn;ig h&eacute;rna.</a></td>
</tr>
</form>
</table>
