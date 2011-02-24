<?php
	//include_once('modules/products/include/class.product.php');

	$this->assign('list', $this->cookies()->get('_content'));
	$this->add_tpl('confirm');
	//$this->log(LOG_ERROR, 'Helloe, word!');
	$this->add_ajax_tpl('confirm');
?>