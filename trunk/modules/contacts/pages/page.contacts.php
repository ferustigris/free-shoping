<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->assign('icq', $this->options()->get('icq'));
	$this->assign('phone', $this->options()->get('phone'));
	$this->assign('address', $this->options()->get('address'));
	$this->assign('email', $this->options()->get('email'));
	$this->assign('name', $this->options()->get('name'));
	$authorized = false;
	if($mod_auth = $this->get_module('auth'))
		if($user = $mod_auth->get_var('user'))
			$authorized = ($user->priority() < AUTH_NOBODY);
	$this->assign('authorized', $authorized);
	$this->add_tpl('contacts');
	$this->add_ajax_tpl('contacts');
?>