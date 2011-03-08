<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/products/include/class.product.php');
	include_once('modules/orders/include/class.order.php');
	$orders = Array();
	if($parent_order = new Order($this, -1))
	{
		$orders = $parent_order->child();
	};
	$states = Array();
	if($state = new State($this, -1))
		$states = $state->states();
	$this->assign("list", $orders);
	$this->assign("states", $states);
	$this->add_tpl("orders");
	$this->add_ajax_tpl("orders");
?>