<?php
	//include_once 'class.installer.php';
	$this->log(LOG_ERROR, 'MOVE THIS CODE!');
	if($module = $this->forms_post()->get('module'))
	{
		$this->log(LOG_DEBUG, 'install module: '.$module);
		$installer = new Installer();
		//распаковка и скачка файлов еще будет
		//$installer->install($module);
	}
?>
