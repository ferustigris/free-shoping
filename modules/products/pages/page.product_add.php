<?php
	include_once('modules/categories/include/class.category.php');
	include_once('modules/products/include/class.material.php');
	include_once('modules/products/include/class.producer.php');
	include_once('modules/products/include/class.size.php');
	if($cats = new Category($this, -1))
	{
		$this->assign('allcats', $cats->all());
		if(!($parent_product_id = $this->forms_get()->get('parent_product_id')))
			$parent_product_id = -1;
		$this->assign('parent_product', $parent_product_id);
		$this->add_tpl('add_product_form');
		if($mat = new Material($this, -1))
			$this->assign('materials', $mat->all());
		if($producer = new Producer($this, -1))
			$this->assign('producers', $producer->all());
		if($size = new Size($this, -1))
			$this->assign('sizes', $size->all());
	}
?>