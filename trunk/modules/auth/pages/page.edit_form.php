<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->assign('user', $this->get_var('user'));
	$this->add_tpl('edit_form');
	$this->add_ajax_tpl('edit_form');
?>