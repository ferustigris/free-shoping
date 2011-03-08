<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/products/include/class.product.php');
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
		if($mat = new Material($this, -1))
			$this->assign('materials', $mat->all());
		if($producer = new Producer($this, -1))
			$this->assign('producers', $producer->all());
		if($size = new Size($this, -1))
			$this->assign('sizes', $size->all());
		if($id = $this->forms_get()->get('product_id'))
			if($product = new Product($this, $id))
			{
				$this->assign('product', $product);
				$this->add_tpl('edit_product_form');
			}
	}
?>