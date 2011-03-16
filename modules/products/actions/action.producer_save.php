<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/products/include/class.producer.php');
	if($producer = new Producer($this, -1))
	{
		if($name = $this->forms_post()->get('producer_name'))
		{
				if($new_prod = $producer->add($name, $description))
				{
					$new_prod->set('description', $this->forms_post()->get('product_description'));
					$new_prod->set('url', $this->forms_post()->get('url'));
				} else
					$this->log(LOG_ERROR, 'Can not create producer!');
		}
		else
			$this->log(LOG_ERROR, 'Can not open fields!');
	}
	$this->add_tpl('add_producer_form');
?>