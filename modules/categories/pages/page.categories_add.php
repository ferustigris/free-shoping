<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/categories/include/class.category.php');
	if($cats = new Category($this, -1))
	{
		$this->assign('all', $cats->all());
		$this->add_tpl('add_category_form');
		$this->add_ajax_tpl('add_category_form');
	}
?>