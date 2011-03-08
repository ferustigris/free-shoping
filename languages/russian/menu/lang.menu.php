<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->data['modules/menu/tpl.menu.html'] = 'Меню';
?>