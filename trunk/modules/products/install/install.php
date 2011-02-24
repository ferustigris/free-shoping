<?php
	$this->addPage('products_list', 0, 10000, 'products list');
	$this->addPage('product_edit', 0, 100, 'edit product');
	$this->addPage('product_page', 0, 10000, 'product name');
	$this->addPage('product_menu', 0, 100, 'product menu');
	$this->addPage('product_add', 0, 100, 'add product');
	$this->addPage('material_add', 0, 100, 'materials');
	$this->addPage('producer_add', 0, 100, 'producers');
	$this->addPage('size_add', 0, 100, 'product sizes');
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