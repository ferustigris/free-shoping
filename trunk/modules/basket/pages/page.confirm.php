<?php
	include_once('modules/products/include/class.product.php');
	if($id = $this->forms_post()->get('id_product'))
	{
		if($p = new Product($this, $id))
		{
			$this->assign('product', $p);
			$this->add_tpl('confirm');
			$this->add_ajax_tpl('added_product');
		}
	}
?>