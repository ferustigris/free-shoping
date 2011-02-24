<?php
	//! save login and password to cookies session
	$this->log(LOG_DEBUG, 'action enter');
	$login = $this->forms_post()->get('login');
	$password = sha1($this->forms_post()->get('password'));
	if($login&&$password)
	{
		$this->sessions()->set('login', $login);
		$this->sessions()->set('password', $password);
	}
	$this->init() ;
?>