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
?>