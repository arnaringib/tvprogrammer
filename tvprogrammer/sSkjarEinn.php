<link href="main.css" rel="stylesheet" type="text/css"> 
<?php include('functions.php'); 
	$ar = array();
	$newAr = array();
	$date = date('Y-m-d');
	//echo $date;
	$ar = getSkjareinn($date);
	print_r ($ar);
	$i = 0;
	while($i<count($ar)) {
		array_push($newAr,($ar[$i][4]));
		$i++;
	}
?>
<table>
	<tr>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')); ?></td></tr>
				<tr class="header"><td> <?php echo date('d F');?> </td></tr>
				<tr><td><?php print_r ($newAr); ?></td></tr>
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

