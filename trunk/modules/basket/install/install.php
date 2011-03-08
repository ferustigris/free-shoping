<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->addPage('basket', 0, 10000, 'basket', 0);
	$this->addPage('confirm', 0, 10000, 'Confirmation form', 1);
	$this->addAction('add_product', 0, 10000, 'Add product');
	$this->addAction('remove_product', 0, 10000, 'Remove product');
	$this->addAction('confirm', 0, 10000, 'Confirm');
?>