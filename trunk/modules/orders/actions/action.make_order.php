<?php
	include_once('modules/products/include/class.product.php');
	include_once('modules/orders/include/class.order.php');
	$i = 0;
	$products = Array();
	while($id_product = $this->forms_post()->get('id_product'.$i))
	{
		$id_size = $this->forms_post()->get('id_size'.$i);
		if(!$id_size)$id_size = -1;
		$products[] = Array('product' => new Product($this, $id_product), 'size' => new Size($this, $id_size));
		$i++;
	}
	/*if($id_product = $this->forms_post()->get('id_product'))
	{
		if($new_product = new Product($this, $id))
		{

		}
	}*/
	foreach($products as $product_line)
	{
		$this->log(LOG_ERROR, $product_line['product']->product());
	}

?>