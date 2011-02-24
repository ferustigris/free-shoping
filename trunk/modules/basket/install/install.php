<?php
	$this->addPage('basket', 0, 10000, 'basket');
	$this->addPage('confirm', 0, 9999, 'Confirmation form');
	$this->addPage('added_product', 0, 9999, 'Added product. For ajax');
	$this->addAction('add_product', 0, 10000, 'Add product');
	$this->addAction('remove_product', 0, 10000, 'Remove product');
	$this->addAction('confirm', 0, 9999, 'Confirm');
?>