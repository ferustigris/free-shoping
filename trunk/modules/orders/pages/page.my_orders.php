<?php
	include_once('modules/products/include/class.product.php');
	include_once('modules/orders/include/class.order.php');
	$my_orders = Array();
	if($userm = $this->get_module('auth'))
	{
		if(($parent_order = new Order($this, -1))&&($user = $userm->get_var('user')))
		{
			$orders = $parent_order->child();
			foreach($orders as $order)
			{
				if($order->user_id() == $user->id())
					$my_orders[] = $order;
			}
		} else $this->log(LOG_ERROR, "You are not found!");
	} else $this->log(LOG_ERROR, "Module auth not found!");
	$this->assign("list", $my_orders);
	$this->add_tpl("my_orders");
	$this->add_ajax_tpl("my_orders");
?>