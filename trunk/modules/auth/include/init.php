<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once 'class.user.php';
	$login = $this->sessions()->get('login');
	$password = $this->sessions()->get('password');
	if(!$login||!$password)
	{
		$login = '';
		$password = '';
	}
	$this->set_var('user', new UserImpl($login, $password));
	$this->log(LOG_DEBUG, 'PRIOR='.$this->get_var('user')->priority());
	$this->cookies()->set('enable', $this->get_var('user')->priority() < AUTH_NOBODY ? 'true' : '');
?>
