<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/products/include/class.product.php');
	if($id = intval($this->forms_get()->get('product_id')))
		if($product = new Product($this, $id))
		{
			while($product->parent()->id() > -1)
				$product = $product->parent();
			$this->assign('product', $product);
			$this->load('product_menu');
			//$this->load('products_list');
			$this->add_tpl('product_page');
			$this->add_ajax_tpl('product_page');
		}
?>