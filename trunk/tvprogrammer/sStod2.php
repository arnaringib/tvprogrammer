<link href="main.css" rel="stylesheet" type="text/css"> 
<?php
	include('functions.php');
	$date = date('Y-m-d');
?>
<table>
	<tr>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')); ?></td></tr>
				<tr class="header"><td> <?php echo date('d F');?> </td></tr>
				<tr><td><?php getStod2Today(); ?></td></tr>
			</table>
		</td>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')+1); ?></td></tr>
				<tr class="header"><td> <?php echo date('d')+1 . ' ' . date('F');?> </td></tr>
				<tr><td><?php getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")+1, date("Y")))); ?></td></tr>
			</table>
		</td>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')+2); ?></td></tr>
				<tr class="header"><td> <?php echo date('d')+2 . ' ' . date('F');?> </td></tr>
				<tr><td><?php getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")+2, date("Y")))); ?></td></tr>
			</table>
		</td>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')+3); ?></td></tr>
				<tr class="header"><td> <?php echo date('d')+3 . ' ' . date('F')?> </td></tr>
				<tr><td><?php getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")+3, date("Y")))); ?></td></tr>
			</table>
		</td>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')+4); ?></td></tr>
				<tr class="header"><td> <?php echo date('d')+4 . ' ' . date('F');?> </td></tr>
				<tr><td><?php getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")+4, date("Y"))));?></td></tr>
			</table>
		</td>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')+5); ?></td></tr>
				<tr class="header"><td> <?php echo date('d')+5 . ' ' . date('F');?> </td></tr>
				<tr><td><?php getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")+5, date("Y")))); ?></td></tr>
		</table>
		</td>
		<td class="day">
			<table>
				<tr class="header"><td><?php getWeekday(date('N')+6); ?></td></tr>
				<tr class="header"><td> <?php echo date('d')+6 . ' ' . date('F');?> </td></tr>
				<tr><td><?php getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")+6, date("Y"))));?></td></tr>
			</table>
		</td>
	</tr>
</table>

