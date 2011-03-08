<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	/*$this->addPage('enter_form', 10000, 10000, 'Authorisation form');
	$this->addAction('enter', 0, 10000, 'Enter user');
	*/
	$this->addPage('menu', 0, 10000, 'Menu', 0);
?>