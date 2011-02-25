<?php
	include_once "libs/init.php";
	include_once "libs/class.settings.php";
	global $settings;
	$settings = new Settings($_SERVER["DOCUMENT_ROOT"]."/settings.php") ;
	if(installed())
	{
		init() ;
		html() ;
	}
	else
	{
		include "install/install.php";
	}
?>
