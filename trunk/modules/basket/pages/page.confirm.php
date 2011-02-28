<?php
	include_once('modules/products/include/class.product.php');
	$str = $this->cookies()->get('content');
	if(!$str)
	{
		$str = $this->options()->get($_SERVER['REMOTE_ADDR']);
	}
	//echo $str;
	$products = Array() ;
	$products_sizes = Array() ;
	$products_childs = Array() ;
	$products_lines = explode(';', $str);
	if($str)
	{
		foreach($products_lines as $line)
		{
			$new_child = NULL;
			$new_product = NULL;
			$entry_lines = explode(',', $line);
			foreach($entry_lines as $entry_line)
			{
				$value_lines = explode('=', $entry_line);
				if(count($value_lines) == 2)
				{
					if($value_lines[0] == 'id_product')
					{
						if($new_product = new Product($this, $value_lines[1]))
						{
							$products_sizes[$new_product->id()] = Array();
							$products_childs[$new_product->id()] = Array();
						}
					} else
					if ($new_product)
					{
						if($value_lines[0] == 'id_child')
						{
							//$products_childs[$new_product->id()][] = new Product($this, $value_lines[1]));
							$new_child = new Product($this, $value_lines[1]);
							$products_childs[$new_product->id()][] = $new_child;
						} else
						if(($new_child)&&($value_lines[0] == 'id_size'))
						{
							$products_sizes[$new_product->id()][$new_child->id()] = $value_lines[1];
						}
					}
				}
			}
			if($new_product)
			{
				$products[] = $new_product;
			}
		}
	} else $this->log(LOG_NOTICE, 'No enought actual products!');
	$this->assign('products', $products);
	$this->assign('childs', $products_childs);
	$this->assign('child_sizes', $products_sizes);
	//$this->log(LOG_ERROR, 'Helloe, word!');
	$this->cookies()->set('content', '');
	$this->add_ajax_tpl('confirm');
	$this->add_tpl('confirm');
?>