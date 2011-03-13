<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->addPage('categories_list', 0, 10000, 'categories list', 1);
	$this->addPage('category_edit', 0, 100, 'edit category', 0);
	$this->addPage('categories_tree', 0, 10000, 'view categories tree', 0);
	$this->addAction('category_save', 0, 100, 'save category');
	$this->addPage('categories_add', 0, 100, 'category add', 1);
?>