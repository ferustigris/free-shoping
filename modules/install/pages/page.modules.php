<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/install/include/class.installer.php');
	if($installer = new Installer())
	{
	    $this->assign('modules', $installer->modules());
	}
	$this->add_tpl('modules');
	$this->add_ajax_tpl('modules');
?>