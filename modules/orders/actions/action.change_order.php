<?php
	include_once('modules/products/include/class.product.php');
	include_once('modules/orders/include/class.order.php');
	if(($id_order = intval($this->forms_post()->get('id_order')))&&($id_state = intval($this->forms_post()->get('id_state'))))
	{
		if($order = new Order($this, $id_order))
		{
			$order->set_state($id_state);
		} else $this->log(LOG_ERROR, "Could not create order!");
	} else $this->log(LOG_ERROR, "No enought actual parameters!");
?>