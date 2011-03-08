<?php
	include_once 'class.logger.php';
	$this->set_var('log', new Logger(intval($this->settings()->get("log_level")), ''));
?>
