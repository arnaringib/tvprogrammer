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
			
			$dName = $dom->createElement('name',utf8_encode($name));
			$dEmail = $dom->createElement('email',utf8_encode($email));
			$dUsername = $dom->createElement('username',utf8_encode($username));
			$dPassword = $dom->createElement('password',utf8_encode(md5($password)));
			
			$user->appendChild($dName);
			$user->appendChild($dEmail);
			$user->appendChild($dUsername);
			$user->appendChild($dPassword);
			
			$users->item(0)->appendChild($user);
			
			$dom->save($file);
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
				array_push($ar,array($eventid, $serieid, $starttime, $duration, $title->item(0)->nodeValue));
			$i++;
		}
		
		return $ar;
	}
?>
