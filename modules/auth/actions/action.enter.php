<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once 'modules/auth/include/class.user.php';
	//! save login and password to cookies session
	$this->log(LOG_DEBUG, 'action enter');
	$login = $this->forms_post()->get('login');
	$password = sha1($this->forms_post()->get('password'));
	if($login&&$password)
	{
		$this->sessions()->set('login', $login);
		$this->sessions()->set('password', $password);
	}
	if($user = new UserImpl($login, $password))
	{
		if($user->priority() >= AUTH_NOBODY)
		{
			setcookie('redirect', '');
			$this->log(LOG_ERROR, "Login or password incorrect!");
		} else
		{
			$this->redirect("index.php");
		}
	}
?>