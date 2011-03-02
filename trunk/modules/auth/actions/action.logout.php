<?php
	if($user = $this->get_var('user'))
	{
		$user->logout();
		$this->sessions()->set('login', NULL);
		$this->sessions()->set('password', NULL);
		$this->redirect("index.php") ;
	}
?>