<?php
	session_start();
	include('functions.php');
	$date = $_SESSION['date'];
	if(!isset($_GET['date'])){
		$date = date('j');
	}
	else if($_GET['date'] == 1){
			$date+=1;
	}
	else if($_GET['date'] == 2){
		$date-=1;
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
<input type="button" value="Skr&aacute; v&ouml;ldu &thorn;&aelig;ttina" onclick="day()"/>
<div id="last"><a href="javascript:getLastDay()"><img src="img/back.png" align="middle" /></a></div>
<div id="next"><a href="javascript:getNextDay()"><img src="img/forward.png" align="middle" /></a></div>

<div id="test"></div>
<table id="tableCal" align="center" cellspacing="5px">
	<tr>
		<tr class="header">
			<td colspan="3" class="CalDay" align="center"><?php getWeekday(date('N')); echo "<BR>" . date('d. ', mktime(0, 0, 0, date("m"), $date, date("Y"))) . getMonth(date('n', mktime(0, 0, 0, date("m"), $date, date("Y"))))?> </td>
		</tr>
		<tr>
			<td align="center">R&uacute;v</td>
			<td align="center">St&ouml;&eth; 2</td>
			<td align="center">Skj&aacute;r Einn</td>
		</tr>
		<tr class="content">
			<td><?php getRuv(date('Y-m-d', mktime(0, 0, 0, date("m"), $date, date("Y")))); ?></td>
			<td><?php  if(strcmp(date('Y-m-d', mktime(0, 0, 0, date('m'), $date, date('y'))), date('Y-m-d')) == 0) getStod2Today(); else  getStod2(date('Y-m-d', mktime(0, 0, 0, date("m"), $date, date("Y"))),$index);?></td>
			<td><?php getSkjarEinn(date('Y-m-d', mktime(0, 0, 0, date("m"), $date, date("Y"))),$index); ?></td>
		</tr>
	</tr>
</table>
<div id="showChannelInfo"></div>