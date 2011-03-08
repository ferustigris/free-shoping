<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->addPage('products_list', 0, 10000, 'products list', 0);
	$this->addPage('product_edit', 0, 100, 'edit product', 0);
	$this->addPage('product_page', 0, 10000, 'product name', 0);
	$this->addPage('product_menu', 0, 100, 'product menu', 0);
	$this->addPage('product_add', 0, 100, 'add product', 1);
	$this->addPage('material_add', 0, 100, 'materials', 1);
	$this->addPage('producer_add', 0, 100, 'producers', 1);
	$this->addPage('size_add', 0, 100, 'product sizes', 1);
	$this->addAction('size_save', 0, 100, 'save size');
	$this->addAction('size_remove', 0, 100, 'remove size');
	$this->addAction('material_save', 0, 100, 'save material');
	$this->addAction('material_remove', 0, 100, 'remove material');
	$this->addAction('producer_save', 0, 100, 'save producer');
	$this->addAction('producer_remove', 0, 100, 'remove producer');
	$this->addAction('product_save', 0, 100, 'save product');
	$this->addAction('product_edit', 0, 100, 'save created product');
	$this->addAction('product_buy', 0, 10000, 'buy product');
	$this->addAction('product_remove', 0, 10000, 'remove product');
?>