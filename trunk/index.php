<?php
	include_once "libs/init.php";
	if(installed())
	{
		init() ;
		html() ;
	}
	else
		include "install/install.php";
?>
