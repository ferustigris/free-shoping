<?php
	//include_once("include/iface.log.php");
	include_once('modules/products/include/class.product.php');
	//! save login and password to cookies session
	//$this->log(LOG_NOTICE, 'product added = '.$this->forms_post()->get('id_product'));
	$str = '';
	if($this->options()->get($_SERVER['REMOTE_ADDR']))
		$str = $this->options()->get($_SERVER['REMOTE_ADDR']);
	$valid = true;
	if($id = $this->forms_post()->get('id_product'))
	{
		if($new_product = new Product($this, $id))
		{
			$str = $str.'id_product='.$id.',';
			$valid = count($new_product->child()) == 0;
			foreach($new_product->child() as $child)
			{
				if($this->forms_post()->get('item_'.$child->id()))
				{
					if($size = $this->forms_post()->get('item_size_'.$child->id()))
					{
						$str = $str.'id_child='.$child->id().',id_size='.$size.',';
						$valid = true;
					}
				}
			}
		}
		if($valid)
		{
			$str = $str.';';
			$this->options()->set($_SERVER['REMOTE_ADDR'], $str);
			$this->redirect('index.php?module=products&page=product_page&product_id='.$id);
		}

	} else
	$this->log(LOG_ERROR, "Can't add product! No enougth actual parameters?");
?>