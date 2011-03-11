<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->add_tpl('message');
	$this->add_ajax_tpl('message');
?>