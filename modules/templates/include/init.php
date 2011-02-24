<?php
	include_once 'class.tpl.php';
	$this->set_var('template', new Tpl($this, $GLOBALS['settings']->get('template'))) ;
?>
