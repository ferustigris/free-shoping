<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once 'class.tpl.php';
	$tpl = $GLOBALS['settings']->get('template');
	if(!$tpl)$tpl = "default";
	$this->set_var('template', new Tpl($this, $tpl)) ;
?>
