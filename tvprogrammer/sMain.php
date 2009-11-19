Velkomin/n 
<?php 
	echo $_SESSION['name']; 
?> <div>N&aacute; &iacute; dagatali&eth; &aacute; iCalendar formi: <a href="createCalender.php">H&eacute;rna.</a></div>
<br />
<input type="button" value="Ey&eth;a v&ouml;ldum &thorn;&aacute;ttum" onclick="eyda()"/>
<link href="main.css" rel="stylesheet" type="text/css">
<div id="userCalender"></div>
<div id="calLoading">Verið er að uppfæra dagatalið þitt, vinsamlegast hinkraðu...</div>