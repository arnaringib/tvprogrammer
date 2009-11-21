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
<form>
<input type="button" value="Skr&aacute; v&ouml;ldu &thorn;&aelig;ttina" onclick="skjarEinn()"/>
<a href="javascript:getLastSkjarEinn()">Fyrri vika</a>
<a href="javascript:getNextSkjarEinn()">N&aelig;sta vika</a>

<div id="test"></div>
<table>
        <tr>
                <td class="day">
                        <table>
                                <tr class="header"><td><?php getWeekday(date('N')+1); ?></td></tr>
                                <tr class="header"><td> <?php echo date('d.m', mktime(0, 0, 0, date('m'), $date, date('y')));?> </td></tr>
                                <tr><td><?php getSkjarEinn(date('Y-m-d', mktime(0, 0, 0, date("m"), $date, date("Y"))),$index); ?></td></tr>
                        </table>
                </td>
                <td class="day">
                        <table>
                                <tr class="header"><td><?php getWeekday(date('N')+1); ?></td></tr>
                                <tr class="header"><td> <?php echo date('d. F', mktime(0, 0, 0, date('m'), $date+1, date('y')));?> </td></tr>
                                <tr><td><?php getSkjarEinn(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+1, date("Y"))),$index); ?></td></tr>
                        </table>
                </td>
                <td class="day">
                        <table>
                                <tr class="header"><td><?php getWeekday(date('N')+2); ?></td></tr>
                                <tr class="header"><td> <?php echo date('d. F', mktime(0, 0, 0, date('m'), $date+2, date('y')));?> </td></tr>
                                <tr><td><?php getSkjarEinn(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+2, date("Y"))),$index); ?></td></tr>
                        </table>
                </td>
                <td class="day">
                        <table>
                                <tr class="header"><td><?php getWeekday(date('N')+3); ?></td></tr>
                                <tr class="header"><td> <?php echo date('d. F', mktime(0, 0, 0, date('m'), $date+3, date('y')));?> </td></tr>
                                <tr><td><?php getSkjarEinn(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+3, date("Y"))),$index); ?></td></tr>
                        </table>
                </td>
                <td class="day">
                        <table>
                                <tr class="header"><td><?php getWeekday(date('N')+4); ?></td></tr>
                                <tr class="header"><td> <?php echo date('d. F', mktime(0, 0, 0, date('m'), $date+4, date('y')));?> </td></tr>
                                <tr><td><?php getSkjarEinn(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+4, date("Y"))),$index);?></td></tr>
                        </table>
                </td>
                <td class="day">
                        <table>
                                <tr class="header"><td><?php getWeekday(date('N')+5); ?></td></tr>
                                <tr class="header"><td> <?php echo date('d. F', mktime(0, 0, 0, date('m'),$date+5, date('y')));?> </td></tr>
                                <tr><td><?php getSkjarEinn(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+5, date("Y"))),$index); ?></td></tr>
                </table>
                </td>
                <td class="day">
                        <table>
                                <tr class="header"><td><?php getWeekday(date('N')+6); ?></td></tr>
                                <tr class="header"><td> <?php echo date('d. F', mktime(0, 0, 0, date('m'), $date+6, date('y')));?> </td></tr>
                                <tr><td><?php $index = getSkjarEinn(date('Y-m-d', mktime(0, 0, 0, date("m"), $date+6, date("Y"))),$index);?><input type="hidden" name="index" value="<?php echo $index; ?>"</td></td></tr>
                        </table>
                </td>
        </tr>
</table>

</form>
