<?php 
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
	function getRuv($dateFrom){
		$file = 'http://muninn.ruv.is/files/xml/sjonvarpid/' . $dateFrom . '/';

		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$service = $schedule->item(0)->getElementsByTagName('service');
		$event = $dom->getElementsByTagName('event');
	
		$count = $event->length;
		
		$i = 0;
		
		$ar = array();

		while($i != $count){
			$eventid = $event->item($i)->getAttribute('event-id');
			$title = $event->item($i)->getElementsByTagName('title');
			$serieid = $event->item($i)->getAttribute('serie-id');
			$starttime = $event->item($i)->getAttribute('start-time');
			$duration = $event->item($i)->getAttribute('duration');
			
			array_push($ar,array($eventid, $serieid, $starttime, $duration, $title->item(0)->nodeValue));
			$i++;
		}
		
		return $ar;
	}
	
	function getSkjareinn($date){
		$file = 'http://skjarinn.is/einn/dagskrarupplysingar/?weeks=2&output_format=xml';

		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$service = $schedule->item(0)->getElementsByTagName('service');
		$event = $dom->getElementsByTagName('event');
	
		$count = $event->length;
		
		$i = 0;
		
		$ar = array();

		while($i != $count){
			$eventid = $event->item($i)->getAttribute('event-id');
			$title = $event->item($i)->getElementsByTagName('title');
			$serieid = $event->item($i)->getAttribute('serie-id');
			$starttime = $event->item($i)->getAttribute('start-time');
			$duration = $event->item($i)->getAttribute('duration');
			
			if(strcmp(substr($starttime,0,10),$date) == 0)
				array_push($ar,array($eventid, $serieid, $starttime, $duration, utf8_decode($title->item(0)->nodeValue)));
			$i++;
		}
		$k=0;
		while($k<count($ar)){
			$time = substr($ar[$k][2], 11); 
			echo "<tr><td>"  . $time . " " . $ar[$k][4] . "</tr></td>"; 
			$k++; 
		}
		return 0;
	}
	
	function getStod2($date){
		$file = 'http://stod2.visir.is/?pageid=247';
		
		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$event = $dom->getElementsByTagName('event');
		//series = $dom->getElementsByTagName('series');		
		
		$count = $event->length;
		
		$ar = array();
		
		$i = 0;
		while($i != $count){
			$service = $event->item($i)->getElementsByTagName('service');
			$title = $event->item($i)->getElementsByTagName('title');
			//$episode = $series->item($i)->getAttribute('series');
			$eventid = $event->item($i)->getAttribute('event_id');
			$starttime = $event->item($i)->getAttribute('starttime');
			$duration = $event->item($i)->getAttribute('duration');
			
			if(strcmp(substr($starttime,0,10),$date) == 0)
				array_push($ar,array($eventid, $starttime, $duration, $title->item(0)->nodeValue));
			$i++;
		}
	}
	
	function getWeekday($nr){
		if( $nr>7 ){
			$nr -= 7;
		}
		switch ($nr) {
			case 1:
				echo "Mánudagur";
				break;
			case 2:
				echo "Þriðjudagur";
				break;
			case 3:
				echo "Miðvikudagur";
				break;
			case 4:
				echo "Fimmtudagur";
				break;
			case 5:
				echo "Föstudagur";
				break;
			case 6:
				echo "Laugardagur";
				break;
			case 7:
				echo "Sunnudagur";
				break;
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
?>
