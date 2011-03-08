<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->add_tpl('registration_form');
	$this->add_ajax_tpl('registration_form');
?>