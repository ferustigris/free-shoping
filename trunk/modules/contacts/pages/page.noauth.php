<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->add_tpl('noauth');
	$this->add_ajax_tpl('noauth');
?>