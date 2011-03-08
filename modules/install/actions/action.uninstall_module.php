<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/install/include/class.installer.php');
	if($installer = new Installer())
	{
		foreach($installer->modules() as $module)
		if($module = $this->forms_post()->get($module->name()))
		{
			$installer->uninstall($module);
			$this->log(LOG_ERROR, "Module uninstalled: ".$module);
		}
	}
?>