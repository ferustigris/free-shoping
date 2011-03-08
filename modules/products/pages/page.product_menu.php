<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	if($id = $this->forms_get()->get('product_id'))
	{
		$this->add_tpl('product_menu');
		$this->add_ajax_tpl('product_menu');
	}
?>