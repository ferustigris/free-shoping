<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->addPage('modules', 0, 100, 'modules list', 1);
	$this->addAction('install_module', 0, 100, 'install module');
	$this->addAction('uninstall_module', 0, 100, 'uninstall module');
?>