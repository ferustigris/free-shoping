<?php
	include_once('modules/products/include/class.material.php');
	if($mat = new Material($this, -1))
	{
		$this->assign('materials', $mat->all());
		$this->add_tpl('add_material_form');
		$this->add_ajax_tpl('add_material_form');
	}
?>