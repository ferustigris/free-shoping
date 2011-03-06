<?php
	include_once('modules/products/include/class.product.php');
	include_once('modules/orders/include/class.order.php');
	$orders = Array();
	if($parent_order = new Order($this, -1))
	{
		$orders = $parent_order->child();
	};
	$this->assign("list", $orders);
	$this->add_tpl("orders");
	$this->add_ajax_tpl("orders");
?>