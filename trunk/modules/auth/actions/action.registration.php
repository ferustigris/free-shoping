<?php
	//! save login and password to cookies session
	$login = $this->forms_post()->get('login');
	$password = sha1($this->forms_post()->get('password'));
	$password2 = sha1($this->forms_post()->get('password2'));
	$phone = $this->forms_post()->get('phone');
	$mail = $this->forms_post()->get('mail');
	$address = $this->forms_post()->get('address');
	if($login&&$password&&($password === $password2))
	{
		if($user = $this->get_var('user')->new_user($login, $password, AUTH_USER))
		{
			$this->sessions()->set('login', $login);
			$this->sessions()->set('password', $password);
			if($phone)$user->set('phone', $phone);
			if($mail)$user->set('mail', $mail);
			if($address)$user->set('address', $address);
			$this->init() ;
		}
	}
?>