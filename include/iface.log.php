<?php
if(!defined('LOG_DEBUG'))define('LOG_DEBUG', 7);
if(!defined('LOG_TODO'))define('LOG_TODO', 6);
if(!defined('LOG_NOTICE'))define('LOG_NOTICE', 5);
if(!defined('LOG_INFO'))define('LOG_INFO', 6);
if(!defined('LOG_ERROR'))define('LOG_ERROR', 3);
if(!defined('LOG_HALT'))define('LOG_HALT', 1);
//! abstract class for log
abstract class Log {
	/*! add msg value
	 * \params
	 * - level - level of message
	 * - msg - message
	 * \return no
	 */
	abstract public function add($level, $module, $msg);
}
?>

