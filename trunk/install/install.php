<?php
		global $db;//! DB
		global $settings;//! settings manager
		include_once "libs/class.settings.php";
		include_once "libs/class.database.php";
		include_once "modules/install/include/class.installer.php";
		include_once "modules/languages/include/class.lang.php";
		$lang = new Lang('english');
		$db = new DataBase($settings->get("db_name"), $settings->get("db_prefix"), $settings->get("db_user"), $settings->get("db_passwd"));
		$installer = new Installer();
		$installer->load();
		//$installer->install($module);
?>