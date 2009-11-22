<?php 
	session_start();
	include('functions.php');
	
	$date = $_SESSION['date'];
	if(!isset($_GET['date'])){
		$date = date('j');
	}
	else if($_GET['date'] == 1){
			$date+=7;
	}
	else if(($_GET['date'] == 2 && $_SESSION['date'] > $date)){
			$date-=7;
	}
	$_SESSION['date'] = $date;
?>
<script src="jquery.js"></script>
		<script>
		$(document).ready(function()
		{
		  $("tr:even").css("background-color", "#000033");
		  $("tr:odd").css("background-color", "#003366");
		});
</script>	
<input type="button" value="Skr&aacute; v&ouml;ldu &thorn;&aelig;ttina" onclick="ruv()"/>
<div id="last"><a href="javascript:getLastRuv()">Fyrri vika</a></div>
<div id="next"><a href="javascript:getNextRuv()">N&aelig;sta vika</a></div>

<table id="tableCal">
	<tr>
		<tr class="header">
			<td><?php getWeekday(date('N')); echo "<BR>" . date('d. F', mktime(0, 0, 0, date("m"), $date, date("Y")))?> </td>
			<td><?php getWeekday(date('N')+1); echo "<BR>" . date('d. F', mktime(0, 0, 0, date("m"), $date+1, date("Y"))) ;?> </td>
			<td><?php getWeekday(date('N')+2); echo "<BR>" . date('d. F', mktime(0, 0, 0, date("m"), $date+2, date("Y")))?> </td>
			<td><?php getWeekday(date('N')+3); echo "<BR>" . date('d. F', mktime(0, 0, 0, date("m"), $date+3, date("Y")))?> </td>
			<td><?php getWeekday(date('N')+4); echo "<BR>" . date('d. F', mktime(0, 0, 0, date("m"), $date+4, date("Y")))?> </td>
			<td><?php getWeekday(date('N')+5); echo "<BR>" . date('d. F', mktime(0, 0, 0, date("m"), $date+5, date("Y")))?> </td>
			<td><?php getWeekday(date('N')+6); echo "<BR>" . date('d. F', mktime(0, 0, 0, date("m"), $date+6, date("Y")))?> </td>
		</tr>
	
		<tr class="content">
			<td><?php getRuv(date('Y-m-d', mktime(0, 0, 0, date("m"), $date, date("Y")))); ?></td>
			<td><?php getRuv(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+1, date("Y")))); ?></td>
			<td><?php getRuv(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+2, date("Y")))); ?></td>
			<td><?php getRuv(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+3, date("Y")))); ?></td>
			<td><?php getRuv(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+4, date("Y")))); ?></td>
			<td><?php getRuv(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+5, date("Y")))); ?></td>
			<td><?php getRuv(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+6, date("Y")))); ?></td>
		</tr>
	</tr>
</table>