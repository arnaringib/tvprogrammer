<?php 
	require_once 'other/iCalcreator.php';
	
	function addUser($name,$email,$username,$password){
		$result = false;
		
		$file = 'data/users.xml';
		if(file_exists($file)){
			$dom = new DOMdocument('1.0','UTF-8');
			if(!$dom->load($file)){
				echo 'Can\'t load a document!';
			}
			
			$users = $dom->getElementsByTagName('users');
			$user = $dom->createElement('user');
			
			$dId = $dom->createAttribute('id');
			$dName = $dom->createElement('name',utf8_encode($name));
			$dEmail = $dom->createElement('email',utf8_encode($email));
			$dUsername = $dom->createElement('username',utf8_encode($username));
			$dPassword = $dom->createElement('password',utf8_encode(md5($password)));
			$dCalender = $dom->createElement('calender', utf8_encode('data/calenders/' . $username . '.xml'));
			
			$user->appendChild($dName);
			$user->appendChild($dEmail);
			$user->appendChild($dUsername);
			$user->appendChild($dPassword);
			$user->appendChild($dCalender);
			
			$users->item(0)->appendChild($user);
			
			$dom->save($file);
			
			makeNewCalender($username);
			
			$result = true;
	
			unset($dom);
		}
		else{
			echo 'File cannot be found.';
		}
		return $result;
	}
	
	function chkUser($user){
		$result = false;
	
		$file = 'data/users.xml';
		if(file_exists($file)){
			$dom = new DOMdocument('1.0', 'UTF-8');
			if(!$dom->load($file)){
				echo 'Can\'t load a document!';
			}
			
			$username = $dom->getElementsByTagName('username');
			for($i = 0; $i < $username->length; $i++){
				if(strcmp(utf8_decode($username->item($i)->nodeValue), $user) == 0){
					$result = true;
					break;
				}
			}
		}
		else{
			echo 'File cannot be found.';
		}
		return $result;
	}
	
	function chkLogin($user,$pass){
		$result = false;
	
		$file = 'data/users.xml';
		if(file_exists($file)){
			$dom = new DOMdocument('1.0', 'UTF-8');
			if(!$dom->load($file)){
				echo 'Can\'t load a document!';
			}
			
			$username = $dom->getElementsByTagName('username');
			$password = $dom->getElementsByTagName('password');
			for($i = 0; $i < $username->length; $i++){
				if(strcmp(utf8_decode($username->item($i)->nodeValue), $user) == 0){
					if(strcmp(utf8_decode($password->item($i)->nodeValue),md5($pass)) == 0){
						$result = true;
						break;
					}
				}
			}
		}
		else{
			echo 'File cannot be found.';
		}
		return $result;
	}
	
	function makeNewCalender($username){
		$dom = new DOMdocument('1.0','UTF-8');
		
		$schedule = $dom->createElement('schedule','');
				
		$dom->appendChild($schedule);
			
		$dom->save('data/calenders/' . $username . '.xml');
	
		unset($dom);
	}
	
	function getName($user){
		$result = '';
	
		$file = 'data/users.xml';
		if(file_exists($file)){
			$dom = new DOMdocument('1.0', 'UTF-8');
			if(!$dom->load($file)){
				echo 'Can\'t load a document!';
			}
			
			$username = $dom->getElementsByTagName('username');
			$name = $dom->getElementsByTagName('name');

			for($i = 0; $i < $username->length; $i++){
				if(strcmp(utf8_decode($username->item($i)->nodeValue), $user) == 0){
					$result = utf8_decode($name->item($i)->nodeValue);
					break;
				}
			}
		}
		else{
			echo 'File cannot be found.';
		}
		return $result;
	}
	
	function getCalender($user){
		$result = '';
	
		$file = 'data/users.xml';
		if(file_exists($file)){
			$dom = new DOMdocument('1.0', 'UTF-8');
			if(!$dom->load($file)){
				echo 'Can\'t load a document!';
			}
			
			$username = $dom->getElementsByTagName('username');
			$calender = $dom->getElementsByTagName('calender');

			for($i = 0; $i < $username->length; $i++){
				if(strcmp(utf8_decode($username->item($i)->nodeValue), $user) == 0){
					$result = utf8_decode($calender->item($i)->nodeValue);
					break;
				}
			}
		}
		else{
			echo 'File cannot be found.';
		}
		return $result;
	}
	
	function getRuv($dateFrom){
		$file = 'http://muninn.ruv.is/files/xml/sjonvarpid/' . $dateFrom;

		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$event = $dom->getElementsByTagName('event');
	
		$count = $event->length;
		$i = 0;
		echo '<table>';
		while($i != $count){
			$title = $event->item($i)->getElementsByTagName('title');
			$serieid = $event->item($i)->getAttribute('serie-id');
			$starttime = $event->item($i)->getAttribute('start-time');
			$description = $event->item($i)->getElementsByTagName('description');
			
			$time = substr($starttime, 11, 5); 
			echo '<tr><td><input type="checkbox" name="'.$dateFrom.'" value="'.$i.'" cal="0"/>'  . $time . '</td></tr><tr><td><a href="javascript:showInfoChannels('.substr($dateFrom,0,4).substr($dateFrom,5,2).substr($dateFrom,8,2).','.$i.', 0)">' . htmlentities(utf8_decode($title->item(0)->nodeValue)) . '</a></td></tr>';	 

			$i++;
		}
		echo '</table>';
	}
	
	function getSkjarEinn($date,$index){
		$file = 'http://skjarinn.is/einn/dagskrarupplysingar/?weeks=2&output_format=xml';

		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$event = $dom->getElementsByTagName('event');
	
		$count = $event->length;
		$i = 0;
		$last = 0;
		echo '<table>';
		while($i != $count){
			$title = $event->item($i)->getElementsByTagName('title');
			$serieid = $event->item($i)->getAttribute('serie-id');
			$starttime = $event->item($i)->getAttribute('start-time');
			
			if(strcmp(substr($starttime,0,10),$date) == 0){	
				$time = substr($starttime, 11); 
				echo '<tr><td><input type="checkbox" name="'.$date.'" value="'.($i+$index).'" cal="2"/>'  . $time . '</td></tr><tr><td><a href="javascript:showInfoChannels('.substr($date,0,4).substr($date,5,2).substr($date,8,2).','.$i.', 2)">' . htmlentities(utf8_decode($title->item(0)->nodeValue)) . '</td></tr>';
				$last = $i+$index;
			}
			$i++;
		}
		echo '</table>';
		return $last;
	}
	
	function getStod2($date, $index){
		$file = 'http://stod2.visir.is/?pageid=247';
		
		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$event = $dom->getElementsByTagName('event');
				
		$count = $event->length;
		$i = 0;
		$last = 0;
		echo '<table>';
		while($i != $count){
			$title = $event->item($i)->getElementsByTagName('title');
			$starttime = $event->item($i)->getAttribute('starttime');
		
			if(strcmp(substr($starttime,0,10),$date) == 0){
				$time = substr($starttime, 11, 5); 
				echo '<tr><td><input type="checkbox" name="'.$date.'" value="'.($i+$index).'" cal="1"/>'  . $time . '</td></tr><tr><td><a href="javascript:showInfoChannels('.substr($date,0,4).substr($date,5,2).substr($date,8,2).','.$i.', 1)">' . htmlentities(utf8_decode($title->item(0)->nodeValue)) . '</td></tr>';
				$last = $i+$index;
			}
				
			$i++;
		}
		echo '</table>';
		return $last;
	}
	
	function getStod2Today(){
		$file = 'http://stod2.visir.is/?pageid=258';
		
		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$event = $dom->getElementsByTagName('event');		
		
		$count = $event->length;
		$i = 0;
		echo '<table>';
		while($i != $count){
			$title = $event->item($i)->getElementsByTagName('title');
			$starttime = $event->item($i)->getAttribute('starttime');
			$time = substr($starttime, 11, 5); 
			echo '<tr><td><input type="checkbox" name="' . substr($starttime,0,10) . '" value="'.$i.'" cal="1"/>'  . $time . '</td></tr><tr><td><a href="javascript:showInfoChannels('.date("Y").date("m").date("d").','.$i.', 1)">' . htmlentities(utf8_decode($title->item(0)->nodeValue)) . '</td></tr>';

			$i++;
		}
		echo '</table>';
	}
	
	function getWeekday($nr){
		if( $nr>7 ){
			$nr -= 7;
		}
		switch ($nr) {
			case 1:
				echo "M&aacute;nudagur";
				break;
			case 2:
				echo "&THORN;ri&eth;judagur";
				break;
			case 3:
				echo "Mi&eth;vikudagur";
				break;
			case 4:
				echo "Fimmtudagur";
				break;
			case 5:
				echo "F&ouml;studagur";
				break;
			case 6:
				echo "Laugardagur";
				break;
			case 7:
				echo "Sunnudagur";
				break;
		}
	}
	function getMonth($nr){

		switch ($nr) {
			case 1:
				return "Jan&uacute;ar";;
			case 2:
				return "Febr&uacute;";
			case 3:
				return "Mars";;
			case 4:
				return "Apr&iacute;l";
			case 5:
				return "Ma&iacute;";
			case 6:
				return "J&uacute;ni";
			case 7:
				return "J&uacute;li";
			case 8:
				return "&aacute;g&uacute;st";
			case 9:
				return "September";
			case 10:
				return "Okt&oacute;ber";
			case 11:
				return "N&oacute;vember";
			case 12:
				return "Desember";
		}
	}
	
	function getUserData($user){
		$result = array();
	
		$file = 'data/users.xml';
		if(file_exists($file)){
			$dom = new DOMdocument('1.0', 'UTF-8');
			if(!$dom->load($file)){
				echo 'Can\'t load a document!';
			}
			
			$username = $dom->getElementsByTagName('username');
			$name = $dom->getElementsByTagName('name');
			$email = $dom->getElementsByTagName('email');

			for($i = 0; $i < $username->length; $i++){
				if(strcmp(utf8_decode($username->item($i)->nodeValue), $user) == 0){
					array_push($result, utf8_decode($name->item($i)->nodeValue), utf8_decode($email->item($i)->nodeValue));
					break;
				}
			}
		}
		else{
			echo 'File cannot be found.';
		}
		return $result;
	}
	
	function userChange($user,$nName,$nEmail){
		$file = 'data/users.xml';
		if(file_exists($file)){
			$dom = new DOMdocument('1.0', 'UTF-8');
			if(!$dom->load($file)){
				echo 'Can\'t load a document!';
			}
			
			$username = $dom->getElementsByTagName('username');
			$name = $dom->getElementsByTagName('name');
			$email = $dom->getElementsByTagName('email');

			for($i = 0; $i < $username->length; $i++){
				if(strcmp(utf8_decode($username->item($i)->nodeValue), $user) == 0){
					$name->item($i)->nodeValue = utf8_encode($nName);
					$email->item($i)->nodeValue = utf8_encode($nEmail);
					break;
				}
			}
			$dom->save($file);
			
			unset($dom);
		}
		else{
			echo 'File cannot be found.';
		}
	}
	
	function userChangePassword($user,$nPassword){
		$file = 'data/users.xml';
		if(file_exists($file)){
			$dom = new DOMdocument('1.0', 'UTF-8');
			if(!$dom->load($file)){
				echo 'Can\'t load a document!';
			}
			
			$username = $dom->getElementsByTagName('username');
			$password = $dom->getElementsByTagName('password');

			for($i = 0; $i < $username->length; $i++){
				if(strcmp(utf8_decode($username->item($i)->nodeValue), $user) == 0){
					$password->item($i)->nodeValue = utf8_encode(md5($nPassword));
					break;
				}
			}
			
			$dom->save($file);
			
			unset($dom);
		}
		else{
			echo 'File cannot be found.';
		}
	}
	
	function checkInCalender($starttime,$title,$calender,$cal){
		$result = false;
		$userfile = $calender;
		if(file_exists($userfile)){
			$dom = new DOMdocument('1.0', 'UTF-8');
			if(!$dom->load($userfile)){
				echo 'Can\'t load a document!';
			}

			$event = $dom->getElementsByTagName('event');
			$start = 'start-time';

			for($i = 0; $i != $event->length; $i++){
				$title2 = $event->item($i)->getElementsByTagName('title');
				if(strcmp($event->item($i)->getAttribute($start),$starttime) == 0 && strcmp(utf8_decode($title2->item(0)->nodeValue),utf8_decode($title)) == 0){
					$result = true;
					break;
				}
			}
		}
		else{
			echo 'File cannot be found.';
		}
		return $result;
	}
	
	function addToCalender($date, $sid, $calender, $cal){
		$userfile = $calender;
		if(file_exists($userfile)){
			$dom = new DOMdocument('1.0', 'UTF-8');
			if(!$dom->load($userfile)){
				echo 'Can\'t load a document!';
			}
			$station = '';
			$stodtvo = false;
			$uSchedule = $dom->getElementsByTagName('schedule');
			if(strcmp($cal,"0")==0){
				$file = 'http://muninn.ruv.is/files/xml/sjonvarpid/' . $date;
				$start = 'start-time';
				$station = 'Ruv';
			}
			if(strcmp($cal,"1")==0){
				if(strcmp($date,date('Y-m-d')) == 0){
					$file = 'http://stod2.visir.is/?pageid=258';
				}
				else{
					$file = 'http://stod2.visir.is/?pageid=247';
				}	
				$start = 'starttime';
				$stodtvo = true;
				$station = 'Stod 2';
			}
			if(strcmp($cal,"2")==0){
				$file = 'http://skjarinn.is/einn/dagskrarupplysingar/?weeks=2&output_format=xml';
				$start = 'start-time';
				$station = 'Skjar einn';
			}

			$sDom = new DOMdocument('1.0', 'UTF-8');
			if(!$sDom->load($file)){
				echo 'Can\'t load a document!';
			}
			$event = $sDom->getElementsByTagName('event');
			$uEvent = $dom->getElementsByTagName('event');
			$title = $event->item($sid)->getElementsByTagName('title');
			if(!checkInCalender($event->item($sid)->getAttribute($start),$title->item(0)->nodeValue,$userfile,$cal)){
				$bl = $dom->importNode($event->item($sid),true);
				if($stodtvo){
					$attr = $bl->getAttribute('starttime');
					$bl->removeAttribute('starttime');
					$bl->setAttribute('start-time',$attr);
				}
				$uSchedule->item(0)->appendChild($bl);
				$stNode = $dom->createElement('station',$station);
				$uEvent->item($uEvent->length-1)->appendChild($stNode);
				$dom->save($userfile);
			}
		}
		else{
			echo 'File cannot be found.';
		}
	}
	
	function getUserCalender($calender,$date){
		$file = $calender;
		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$event = $dom->getElementsByTagName('event');
	
		$count = $event->length;
		$i = 0;
		echo '<table id="tableContent">';
		while($i != $count){
			$title = $event->item($i)->getElementsByTagName('title');
			$starttime = $event->item($i)->getAttribute('start-time');
			
			if(strcmp(substr($starttime,0,10),$date) == 0){
				$time = substr($starttime, 11, 5); 

				echo '<tr id="row'.$i.'"><td><input type="checkbox" name="" value="'.$i.'" />'  . $time . '</td></tr><tr id="row2'.$i.'"><td><a href="javascript:showInfo('.$i.')">' . htmlentities(utf8_decode($title->item(0)->nodeValue), 0, 41) . '</a></td></tr>';			

			}
			$i++;
		}
		echo '</table>';
	}

	
	function removeFromCalender($calender,$id){
		$file = $calender;

		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
	
		$schedule = $dom->documentElement;


		$event = $schedule->getElementsByTagName('event')->item($id);
		$oldevent = $schedule->removeChild($event);

		$dom->save($file);
	}
	
	function removeOldFromCalender($calender){
		$file = $calender;
		
		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		
		$schedule = $dom->documentElement;
		$event = $dom->getElementsByTagName('event');

		$count = $event->length;
		$i = 0;
		while($i != $count){
			$time = getStartTime($event->item($i)->getAttribute('start-time'));
			$eventTime = mktime($time[3], $time[4], $time[5], $time[1], $time[2], $time[0]);
			$now = mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
			if($eventTime < $now){
				removeFromCalender($calender,$i);
			}
			$i++;
		}
		sortCalendar($calender);
	}
	
	function getStartTime($starttime){
		$ar = array();
//		2009-11-21 10:25:00
		if(strlen($starttime) == 19){
			array_push($ar,substr($starttime,0,4),
					   substr($starttime,5,2),
					   substr($starttime,8,2),
					   substr($starttime,11,2),
					   substr($starttime,14,2),
					   substr($starttime,17,2));
		}
		else{
			array_push($ar,substr($starttime,0,4),
					   substr($starttime,5,2),
					   substr($starttime,8,2),
					   substr($starttime,11,2),
					   substr($starttime,14,2),
					   "00");
		}
					   
		return $ar;
	}
	
	function getDuration($duration){
		$ar = array();
		if(strlen($duration) > 5){
			array_push($ar,substr($duration,0,2),
					   substr($duration,3,2),
					   substr($duration,6,2));
		}
		else{
			array_push($ar, "0" . substr($duration,0,1),
			   substr($duration,2,2),
			   "00");
		}
					   
		return $ar;
	}
	
	function makeIcalender($calender){
		$file = $calender;

		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$event = $dom->getElementsByTagName('event');
		$title = $dom->getElementsByTagName('title');
		$description = $dom->getElementsByTagName('description');
		$station = $dom->getElementsByTagName('station');
				
		$count = $event->length; 
		$i = 0;
		$cal = new vcalendar();
		// Calender Settings
		$cal->setConfig( "unique_id", "tvProgrammer" ); 
		$cal->setProperty( "x-wr-calname", "Tv Programmer"); 
		$cal->setProperty( "version", "2.0");
		$cal->setProperty( "calscale", "GREGORIAN");
		$cal->setProperty( "calscale", "GREGORIAN");
		$cal->setProperty( "method", "PUBLISH");
		
		while($i != $count){
			// Get data from xml.
			$time = getStartTime($event->item($i)->getAttribute('start-time'));
			$duration = getDuration($event->item($i)->getAttribute('duration'));
			$cTitle = utf8_decode($title->item($i)->nodeValue);
			$cDescription = utf8_decode($description->item($i)->nodeValue);
			$cStation = utf8_decode($station->item($i)->nodeValue);
			$cDuration = getStartTime(date('Y-m-d H:i:s', mktime($time[3]+$duration[0], $time[4]+$duration[1], $time[5]+$duration[2], $time[1], $time[2], $time[0])));
			// Create for iCalendar
			$ev = new vevent();	
			$ev->setProperty('created', date('Ymd\THis'));
			$ev->setProperty('dtstart', $time[0],$time[1],$time[2],$time[3],$time[4],$time[5]);
			$ev->setProperty('dtend', $cDuration[0],$cDuration[1],$cDuration[2],$cDuration[3],$cDuration[4],$cDuration[5]);
			$ev->setProperty('summary', $cTitle);
			$ev->setProperty('location', $cStation);
			$ev->setProperty('description', $cDescription);
			$cal->addComponent($ev);
			
			$i++;
		}
		return $cal;
	}
		
	function sortCalendar($calendar){
		$file = $calendar;
		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$event = $dom->getElementsByTagName('event');
		$change = false;
		for($i = 0; $i != $event->length; $i++){
			$min = $i;
			for($j = $i+1; $j != $event->length; $j++){
				$p = getStartTime($event->item($min)->getAttribute('start-time'));
				$q = getStartTime($event->item($j)->getAttribute('start-time'));
				$pDate = mktime($p[3], $p[4], $p[5], $p[1], $p[2], $p[0]);
				$qDate = mktime($q[3], $q[4], $q[5], $q[1], $q[2], $q[0]);
				if($qDate < $pDate){
					$min = $j;
				}
			}
			// Swap
			if($i != $min){
				$node1 = $event->item($min);
				$node2 = $event->item($i);
				
				$node1Clone = $node1->cloneNode(true);
				$node2Clone = $node2->cloneNode(true);
				
				$node1->parentNode->replaceChild($node2Clone, $node1);
				$node2->parentNode->replaceChild($node1Clone, $node2);
				$change = true;
			}
		}
		if($change){
			$dom->save($calendar);
		}
	}
	
	function getShowInfo($calendar, $id){
		$file = $calendar;

		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$event = $dom->getElementsByTagName('event');
		$title = $dom->getElementsByTagName('title');
		$description = $dom->getElementsByTagName('description');
		$station = $dom->getElementsByTagName('station');
		
		$starttime = getStartTime($event->item($id)->getAttribute('start-time'));
		$duration = getDuration($event->item($id)->getAttribute('duration'));
		$cTitle = utf8_decode($title->item($id)->nodeValue);
		$cDescription = utf8_decode($description->item($id)->nodeValue);
		$cStation = utf8_decode($station->item($id)->nodeValue);
		
		return array($starttime,$duration,$cTitle,$cDescription,$cStation);
	}

function getShowInfoChannels($dateFrom, $id,$cal){
		if(strcmp($cal,"0")==0){
			$file = 'http://muninn.ruv.is/files/xml/sjonvarpid/' . $dateFrom;
			$start = 'start-time';
			$station = 'Ruv';
		}
		if(strcmp($cal,"1")==0){
			if(strcmp($dateFrom,date('Y-m-d')) == 0){
				$file = 'http://stod2.visir.is/?pageid=258';
			}
			else{
				$file = 'http://stod2.visir.is/?pageid=247';
			}	
				$start = 'starttime';
				$stodtvo = true;
				$station = 'Stod 2';
		}
			if(strcmp($cal,"2")==0){
				$file = 'http://skjarinn.is/einn/dagskrarupplysingar/?weeks=2&output_format=xml';
				$start = 'start-time';
				$station = 'Skjar einn';
			}


		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$event = $dom->getElementsByTagName('event');
		$title = $dom->getElementsByTagName('title');
		$description = $dom->getElementsByTagName('description');
		
		$starttime = getStartTime($event->item($id)->getAttribute($start));
		$duration = getDuration($event->item($id)->getAttribute('duration'));
		$cTitle = utf8_decode($title->item($id)->nodeValue);
		$cDescription = utf8_decode($description->item($id)->nodeValue);
		$cStation = $station;
		
		return array($starttime,$duration,$cTitle,$cDescription,$cStation);
	}
?>
