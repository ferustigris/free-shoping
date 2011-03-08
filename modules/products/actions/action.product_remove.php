<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/products/include/class.product.php');
	if($id = $this->forms_get()->get('product_id'))
	{
		if($p = new Product($this, $id))
		{
			if(!$p->remove())
				$this->log(LOG_ERROR, 'Can not remove product!');
		}
		else
			$this->log(LOG_ERROR, 'Can not create object!');
	}
	else
		$this->log(LOG_ERROR, 'Can not open fields!');
?>