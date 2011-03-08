<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->assign('users', $this->get_var('user')->users());
	$this->add_tpl('users_list');
	$this->add_ajax_tpl('users_list');
?>