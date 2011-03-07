<?php
include_once "include/iface.log.php";
//! class for message
class Message {
	private $level;//! level
	private $msg;//! log message
	/*! constructor
	 * \params
	 * - level - log level
	 * - message - log message
	 * \return no
	 */
	public function __construct($level, $message)
	{
		$this->msg = $message;
		$this->level = $level;
	}
	/*! log level
	 * \params no
	 * \return no
	 */
	public function level()
	{
		return $this->level;
	}
	/*! log message
	 * \params no
	 * \return no
	 */
	public function message()
	{
		return $this->msg;
	}

}
//! class for log
class Logger extends Log {
	private $name;//! name
	private $level;//! level
	private $msg;//! template for message
	/*! constructor
	 * \params
	 * - level - log level
	 * \return no
	 */
	public function __construct($level)
	{
		$this->msg = array();
		$this->level = $level;
	}
	/*! add msg value
	 * \params
	 * - level - level of message
	 * - module - module
	 * - msg - message
	 * \return no
	 */
	public function add($level, $module, $msg)
	{
		if($level <= $this->level)
		{
			global $modules;
			if(ISSET($modules['languages']))
			{
				if($lang = $modules['languages']->get_var('lang'))
					$msg = $lang->translate($msg);
			}
			$message = ($level == LOG_DEBUG ? $module.": " : "").$msg;
			$message = ($level == LOG_TODO ? $module." TODO: " : "").$msg;
			$this->msg[] = new Message($level, $message);
			if(ISSET($modules['templates']))
			{
				if($tpl = $modules['templates']->get_var('template'))
				{
					$tpl->assign('LOG', 'messages', $this->msg);
				}
			}
		}
	}
}
?>
