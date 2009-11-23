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
	else if($_GET['date'] == 2){
		$date-=7;
	}
	$_SESSION['date'] = $date;
	if(!isset($_GET['index'])){
		$index = 0;
	}
	else{
		$index = $_GET['index'];
	}
?>
<script src="jquery.js"></script>
		<script>
		$(document).ready(function()
		{
		  $("tr:even").css("background-color", "#000033");
		  $("tr:even").css("color", "#CCCCCC");
		  $("tr:odd").css("background-color", "#003366");
		});
</script>	
<input type="button" value="Skr&aacute; v&ouml;ldu &thorn;&aelig;ttina" onclick="stodTvo()"/>
<div id="last"><a href="javascript:getLastStod2()"><img src="img/back.png" align="middle" /></a></div>
<div id="next"><a href="javascript:getNextStod2()"><img src="img/forward.png" align="middle" /></a></div>

<div id="test"></div>
<table id="tableCal">
	<tr>
		<tr class="header">
			<td><?php getWeekday(date('N')); echo "<BR>" . date('d. ', mktime(0, 0, 0, date("m"), $date, date("Y"))) . getMonth(date('n', mktime(0, 0, 0, date("m"), $date, date("Y"))))?> </td>
			<td><?php getWeekday(date('N')+1); echo "<BR>" . date('d. ', mktime(0, 0, 0, date("m"), $date+1, date("Y"))). getMonth(date('n', mktime(0, 0, 0, date("m"), $date+1, date("Y"))))?> </td>
			<td><?php getWeekday(date('N')+2); echo "<BR>" . date('d. ', mktime(0, 0, 0, date("m"), $date+2, date("Y"))) .getMonth(date('n', mktime(0, 0, 0, date("m"), $date+2, date("Y"))))?> </td>
			<td><?php getWeekday(date('N')+3); echo "<BR>" . date('d. ', mktime(0, 0, 0, date("m"), $date+3, date("Y"))). getMonth(date('n', mktime(0, 0, 0, date("m"), $date+3, date("Y"))))?> </td>
			<td><?php getWeekday(date('N')+4); echo "<BR>" . date('d. ', mktime(0, 0, 0, date("m"), $date+4, date("Y"))).getMonth(date('n', mktime(0, 0, 0, date("m"), $date+4, date("Y"))))?> </td>
			<td><?php getWeekday(date('N')+5); echo "<BR>" . date('d. ', mktime(0, 0, 0, date("m"), $date+5, date("Y"))).getMonth(date('n', mktime(0, 0, 0, date("m"), $date+5, date("Y"))))?> </td>
			<td><?php getWeekday(date('N')+6); echo "<BR>" . date('d. ', mktime(0, 0, 0, date("m"), $date+6, date("Y"))).getMonth(date('n', mktime(0, 0, 0, date("m"), $date+6, date("Y"))))?> </td>
		</tr>
	
		<tr class="content">
			<td><?php  if(strcmp(date('Y-m-d', mktime(0, 0, 0, date('m'), $date, date('y'))), date('Y-m-d')) == 0) getStod2Today(); else  getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), $date, date("Y"))),$index);?></td>
			<td><?php getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+1, date("Y"))),$index); ?></td>
			<td><?php getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+2, date("Y"))),$index); ?></td>
			<td><?php getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+3, date("Y"))),$index); ?></td>
			<td><?php getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+4, date("Y"))),$index); ?></td>
			<td><?php getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+5, date("Y"))),$index); ?></td>
			<td><?php $index = getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+6, date("Y"))),$index); ?><input type="hidden" name="index" value="<?php echo $index; ?>" /></td>
		</tr>

	</tr>
</table>
<div id="showChannelInfo"></div>