<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/products/include/class.product.php');
	$id = -1;
	$category_id = -1;
	if($this->forms_get()->get('product_id'))
		$id = intval($this->forms_get()->get('product_id'));
	if($this->forms_get()->get('category_id'))
		$category_id = intval($this->forms_get()->get('category_id'));
	if($product = new Product($this, $id))
	{
		if($id > -1)
			$this->assign('list', $product->child());
		else
			$this->assign('list', $product->all($category_id));
		$this->add_tpl('products_list');
		$this->add_ajax_tpl('products_list');
	}
?>