<?php
	if($user = $this->get_var('user'))
	{
		$user->logout();
		$this->init() ;
	}
?>