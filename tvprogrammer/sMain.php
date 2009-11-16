Velkomin/n 
<?php 
	echo $_SESSION['name']; 
?>
<link href="main.css" rel="stylesheet" type="text/css">
<table>
	<tr>
		<td>
			<select>
			<option>R&uacute;v</option>
			<option>St&ouml;&eth; 2</option>
			<option>Skj&aacute;r einn</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')); ?></td></tr>
				<tr class="header"><td> <?php echo date('d F');?> </td></tr>
				<tr><td><?php ?></td></tr>
			</table>
		</td>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')+1); ?></td></tr>
				<tr class="header"><td> <?php echo date('d')+1 . ' ' . date('F');?> </td></tr>
				<tr><td><?php ?></td></tr>
			</table>
		</td>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')+2); ?></td></tr>
				<tr class="header"><td> <?php echo date('d')+2 . ' ' . date('F');?> </td></tr>
				<tr><td><?php ?></td></tr>
			</table>
		</td>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')+3); ?></td></tr>
				<tr class="header"><td> <?php echo date('d')+3 . ' ' . date('F')?> </td></tr>
				<tr><td><?php ?></td></tr>
			</table>
		</td>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')+4); ?></td></tr>
				<tr class="header"><td> <?php echo date('d')+4 . ' ' . date('F');?> </td></tr>
				<tr><td><?php ?></td></tr>
			</table>
		</td>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')+5); ?></td></tr>
				<tr class="header"><td> <?php echo date('d')+5 . ' ' . date('F');?> </td></tr>
				<tr><td><?php ?></td></tr>
		</table>
		</td>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')+6); ?></td></tr>
				<tr class="header"><td> <?php echo date('d')+6 . ' ' . date('F');?> </td></tr>
				<tr><td><?php ?></td></tr>
			</table>
		</td>
	</tr>
</table>


