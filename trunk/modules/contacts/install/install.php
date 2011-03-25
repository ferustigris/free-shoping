<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->addPage('faq', 0, 10000, 'faq', 1);
	$this->addPage('add_faq', 0, 999, 'add new faq', 1);
	$this->addAction('add_faq', 0, 999, 'add_faq');
?>