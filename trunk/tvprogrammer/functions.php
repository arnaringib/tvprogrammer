<?php 
	function addUser($name,$email,$username,$password){
		$file = 'data/users.xml';
		if(file_exists($file)){
			$dom = new DOMdocument('1.0','UTF-8');
			if(!$dom->load($file)){
				echo "Can't load a document!";
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
			
			unset($dom);
		}
		else{
			echo 'File doesn\'t exist.';
		}
	}
?>