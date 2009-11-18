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

		while($i != $count){
			$title = $event->item($i)->getElementsByTagName('title');
			$serieid = $event->item($i)->getAttribute('serie-id');
			$starttime = $event->item($i)->getAttribute('start-time');
		
			$time = substr($starttime, 11, 5); 
			echo '<tr><td><input type="checkbox" name="'.$dateFrom.'" value="'.$i.'" />'  . $time . '</td></tr><tr><td>' . htmlentities(utf8_decode($title->item(0)->nodeValue)) . '</td></tr>';	 

			$i++;
		}
	}
	
	function getSkjareinn($date){
		$file = 'http://skjarinn.is/einn/dagskrarupplysingar/?weeks=2&output_format=xml';

		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$event = $dom->getElementsByTagName('event');
	
		$count = $event->length;
		$i = 0;

		while($i != $count){
			$title = $event->item($i)->getElementsByTagName('title');
			$serieid = $event->item($i)->getAttribute('serie-id');
			$starttime = $event->item($i)->getAttribute('start-time');
			
			if(strcmp(substr($starttime,0,10),$date) == 0){	
				$time = substr($starttime, 11); 
				echo '<tr><td><input type="checkbox" name="'.$date.'" value="'.$i.'" />'  . $time . '</td></tr><tr><td>' . htmlentities(utf8_decode($title->item(0)->nodeValue)) . '</td></tr>';			
			}
			$i++;
		}
	}
	
	function getStod2($date){
		$file = 'http://stod2.visir.is/?pageid=247';
		
		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$event = $dom->getElementsByTagName('event');
				
		$count = $event->length;
		$i = 0;
		while($i != $count){
			$title = $event->item($i)->getElementsByTagName('title');
			$starttime = $event->item($i)->getAttribute('starttime');
		
			if(strcmp(substr($starttime,0,10),$date) == 0){
				$time = substr($starttime, 11, 5); 
				echo '<tr><td><input type="checkbox" name="'.$date.'" value="'.$i.'" />'  . $time . '</td></tr><tr><td>' . htmlentities(utf8_decode($title->item(0)->nodeValue)) . '</td></tr>';
			}
				
			$i++;
		}
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
		while($i != $count){
			$title = $event->item($i)->getElementsByTagName('title');
			$starttime = $event->item($i)->getAttribute('starttime');


			$time = substr($starttime, 11, 5); 
			echo '<tr><td><input type="checkbox" name="' . substr($starttime,0,10) . '" value="'.$i.'" />'  . $time . '</td></tr><tr><td>' . htmlentities(utf8_decode($title->item(0)->nodeValue)) . '</td></tr>';

			$i++;
		}
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
			if(strcmp($cal,"1")==0){
				$start = 'starttime';
			}
			else{
				$start = 'start-time';
			}
			for($i = 0; $i != $event->length; $i++){
				$title = $event->item($i)->getElementsByTagName('title');
				if(strcmp($event->item($i)->getAttribute($start),$starttime) == 0 && strcmp(utf8_decode($title->item(0)->nodeValue),$title) == 0){
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
	
	function addToCalender($date, $sid, $calender,$cal){
		$userfile = $calender;
		if(file_exists($userfile)){
			$dom = new DOMdocument('1.0', 'UTF-8');
			if(!$dom->load($userfile)){
				echo 'Can\'t load a document!';
			}
			$stodtvo = false;
			$uSchedule = $dom->getElementsByTagName('schedule');
			if(strcmp($cal,"0")==0){
				$file = 'http://muninn.ruv.is/files/xml/sjonvarpid/' . $date;
				$start = 'start-time';			
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
			}
			if(strcmp($cal,"2")==0){
				$file = 'http://skjarinn.is/einn/dagskrarupplysingar/?weeks=2&output_format=xml';
				$start = 'start-time';
			}

			$sDom = new DOMdocument('1.0', 'UTF-8');
			if(!$sDom->load($file)){
				echo 'Can\'t load a document!';
			}
			$event = $sDom->getElementsByTagName('event');
			
			$title = $event->item($sid)->getElementsByTagName('title');
			if(!checkInCalender($event->item($sid)->getAttribute($start),$title->item(0)->nodeValue,$userfile,$cal)){
				$bl = $dom->importNode($event->item($sid),true);
				if($stodtvo){
					$attr = $bl->getAttribute('starttime');
					$bl->removeAttribute('starttime');
					$bl->setAttribute('start-time',$attr);
				}
				$uSchedule->item(0)->appendChild($bl);
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

		while($i != $count){
			$title = $event->item($i)->getElementsByTagName('title');
			$starttime = $event->item($i)->getAttribute('start-time');
			
			if(strcmp(substr($starttime,0,10),$date) == 0){
	
				$time = substr($starttime, 11); 
				echo '<tr><td><input type="checkbox" name="" value="'.$i.'" />'  . $time . '</td></tr><tr><td>' . htmlentities(utf8_decode($title->item(0)->nodeValue)) . '</td></tr>';			
			}
			$i++;
		}
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
	
	function removeOldFromCalender($calender,$id){
		$file = $calender;

		$dom = new DOMdocument('1.0', 'UTF-8');
		if(!$dom->load($file)){
			echo 'Can\'t load a document!';
		}
		$schedule = $dom->getElementsByTagName('schedule');
		$event = $dom->getElementsByTagName('event');
	//	while
//		$event = $schedule->getElementsByTagName('event')->item($id);
//		$schedule->removeChild($event);
		
		$dom->save($file);
	}
?>