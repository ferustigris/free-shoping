<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/menu/include/class.menu.php');
	$menu = new Menu($this, -1);

	$this->assign('menus', $menu->menus());
	$this->add_tpl('menu');
?>