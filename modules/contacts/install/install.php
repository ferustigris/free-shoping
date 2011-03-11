<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->addPage('contacts', 1000, 10000, 'contacts', 1);
	$this->addPage('message', 1000, 9999, 'send message to admin', 0);
	$this->addPage('noauth', 10000, 10000, 'authorized please!', 0);
	$this->addPage('view_contacts', 0, 999, 'view contacts', 1);
	$this->addAction('message', 0, 9999, 'add message');
	$this->addAction('edit', 0, 10000, 'edit contacts');
?>