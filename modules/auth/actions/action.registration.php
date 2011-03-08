<?php
	//! save login and password to cookies session
	$login = $this->forms_post()->get('login');
	$full_name = $this->forms_post()->get('full_name');
	$password = sha1($this->forms_post()->get('password'));
	$password2 = sha1($this->forms_post()->get('password2'));
	$phone = $this->forms_post()->get('phone');
	$mail = $this->forms_post()->get('mail');
	$address = $this->forms_post()->get('address');
	if($login&&$password)
	{
		if(($password === $password2))
		{
			if(strlen($password) >= 3)
			{
				if($m_user = $this->get_var('user'))
				{
					if(!$m_user->user_present($login))
					{
						if($user = $m_user->new_user($login, $password, AUTH_USER))
						{
							$this->sessions()->set('login', $login);
							$this->sessions()->set('password', $password);
							if($full_name)$user->set('full_name', urldecode($full_name));
							if($phone)$user->set('phone', urldecode($phone));
							if($mail)$user->set('mail', urldecode($mail));
							if($address)$user->set('address', urldecode($address));
							$this->log(LOG_NOTICE, "User added!");
							$this->init() ;
						} else $this->log(LOG_ERROR, "Module auth not found!");
					} else $this->log(LOG_ERROR, "User already exists!");
				} else $this->log(LOG_ERROR, "Module auth not found!");
			} else $this->log(LOG_ERROR, "Enter your password more than 3 symbols!");
		} else $this->log(LOG_ERROR, "Passwords not equal!");
	} else $this->log(LOG_ERROR, "No enought actual parameters!");
?>