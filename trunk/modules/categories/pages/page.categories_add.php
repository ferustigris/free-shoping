<?php
	include_once('modules/categories/include/class.category.php');
	if($cats = new Category($this, -1))
	{
		$this->assign('all', $cats->all());
		$this->add_tpl('add_category_form');
	}
?>