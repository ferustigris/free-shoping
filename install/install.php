<?php
		global $db;//! DB
		global $settings;//! settings manager
		include_once "libs/class.settings.php";
		include_once "libs/class.database.php";
		include_once "modules/install/include/class.installer.php";
		include_once "modules/languages/include/class.lang.php";
		$lang = new Lang('english');
		$prefix = $settings->get("db_prefix");
		if(($db = $settings->get("db_name"))&&($user = $settings->get("db_user"))&&($passwd = $settings->get("db_passwd")))
		{
			$db = new DataBase($db, $prefix, $user, $passwd);
		};
		$installer = new Installer();
		$installer->load();
		//$installer->install($module);
?>