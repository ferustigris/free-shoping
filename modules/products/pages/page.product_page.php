<?php
	include_once('modules/products/include/class.product.php');
	if($id = intval($this->forms_get()->get('product_id')))
		if($product = new Product($this, $id))
		{
			$this->assign('product', $product);
			$this->load('product_menu');
			//$this->load('products_list');
			$this->add_tpl('product_page');
			$this->add_ajax_tpl('product_page');
		}
?>