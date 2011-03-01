<?php
	include_once('modules/products/include/class.producer.php');
	if($producer = new Producer($this, -1))
	{
		$this->assign('producers', $producer->all());
		$this->add_tpl('add_producer_form');
		$this->add_ajax_tpl('add_producer_form');
	}
?>