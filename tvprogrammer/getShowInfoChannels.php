<?php
	session_start();
	include('functions.php');
	$id = $_GET['id'];
	$dateFrom = $_GET['dateFrom'];
	echo"test: " . $dateFrom;
	$showInfo = getShowInfoChannels($dateFrom,$id);
	$startTime = $showInfo[0];
	$duration = $showInfo[1];
	$cTitle = $showInfo[2];
	$cDescription = $showInfo[3];
	$cStation = $showInfo[4];
?>
<div class="showInfoHeader">
	<div class="showInfoExit"><a href="javascript:showInfoExit()"><img src="img/close.png" /></a></div>
	<div class="showTitleInfo"><?php echo utf8_encode($cTitle); ?></div>
</div>
<div class="showWWInfo">
	<div class="showStationInfo">St&ouml;&eth;: <?php echo utf8_encode($cStation); ?></div>
	<div class="showTimeInfo">kl: <?php echo $startTime[3] . ':' . $startTime[4]; ?> - <?php echo date('H',mktime($startTime[3]+$duration[0],0,0,0,0,0)) . ':' . date('i',mktime(0,$startTime[4]+$duration[1],0,0,0,0)); ?></div>
</div>
<div class="showDescriptionInfo"><?php echo utf8_encode($cDescription); ?></div>