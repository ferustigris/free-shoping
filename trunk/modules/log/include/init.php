<?php
	include_once 'class.logger.php';
	$this->set_var('log', new Logger(7, ''));//$GLOBALS['settings']->get("log_level"), "/var/www/cms/log/messages.log"));
?>
