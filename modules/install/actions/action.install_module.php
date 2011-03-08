<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/install/include/class.installer.php');
	if($module = $this->forms_post()->get('module_name'))
	{
		if($installer = new Installer())
		{
			$installer->uninstall($module);
			$this->log(LOG_ERROR, "Module uninstalled: ".$module);
			$installer->install($module, '');
			$this->log(LOG_ERROR, "Module installed: ".$module);
		}
	}
?>