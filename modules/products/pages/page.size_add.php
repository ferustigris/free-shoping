<?php
	include_once('modules/products/include/class.size.php');
	if($size = new Size($this, -1))
	{
		$this->assign('sizes', $size->all());
		$this->add_tpl('add_size_form');
	}
?>