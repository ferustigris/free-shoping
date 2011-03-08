<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->addPage('contacts', 0, 10000, 'contacts', 1);
	$this->addPage('view_contacts', 0, 1000, 'view contacts', 1);
	$this->addAction('message', 0, 9999, 'add message');
	$this->addAction('edit', 0, 10000, 'edit contacts');
?>