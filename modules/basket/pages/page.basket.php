<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->add_tpl('basket');
	$basket_count_products_in_basket = 0;
	if($str = $this->options()->get($_SERVER['REMOTE_ADDR']))
	{
		$basket_count_products_in_basket = count(explode(';', $str)) - 1;
	}
	$this->assign('count_products_in_basket', $basket_count_products_in_basket);
?>