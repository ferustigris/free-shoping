<?php
	include_once('modules/products/include/class.product.php');
	include_once('modules/orders/include/class.order.php');
	if($mod_auth = $this->get_module('auth'))
	{
		if($user = $mod_auth->get_var('user'))
		{
			if($user->priority() >= AUTH_NOBODY)
			{
				$this->redirect('index.php?module=auth&page=registration_form');
				die();
			}
		}
	}
	$i = 0;
	$products = Array();
	while($id_product = $this->forms_post()->get('id_product'.$i))
	{
		$id_size = $this->forms_post()->get('id_size'.$i);
		if(!$id_size)$id_size = -1;
		$products[] = Array('product' => new Product($this, $id_product), 'size' => new Size($this, $id_size));
		$i++;
	}
	if((count($products) > 0)&&($userm = $this->get_module('auth')))
	{
		if(($parent_order = new Order($this, -1))&&($user = $userm->get_var('user')))
		{
			if($new_order = $parent_order->add($user->id(), -1, -1))
			{
				foreach($products as $product_line)
				{

					$this->log(LOG_DEBUG, 'Add order '.$product_line['product']->product());
					$new_order->add($user->id(), $product_line['product']->id(), $product_line['size']->id());
				}
			} else $this->log(LOG_ERROR, "Could not create order!");
			if($basketm = $this->get_module('basket'))
				$basketm->cookies()->set('content', '');
			$this->options()->set($_SERVER['REMOTE_ADDR'], '');
		} else $this->log(LOG_ERROR, "Could not create order!");
	} else $this->log(LOG_ERROR, "No enought actual products!");
?>