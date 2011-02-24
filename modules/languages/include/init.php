<?php
	include_once 'modules/languages/include/class.lang.php';
	$this->set_var('lang', new Lang('russian'));
	if($this->get_var('lang'))
		$this->get_var('lang')->load();
?>
