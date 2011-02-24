<?php
include_once "include/iface.list.php";
//! class for manage setting from coocies
class Sessions extends SimpleList {
	private $prefix;
	/*! constructor
	 * \params
	 * - filename - name of file
	 * \return no
	 */
	public function __construct($prefix)
	{
		$this->prefix = $prefix;
		static $isSessionStarted = false;
		if(!$isSessionStarted)
		{
			//session_name('asod9fwe8rf90wji3');
			session_start() ;
			$isSessionStarted = true;
		}
	}
	/*! get value by filed name
	 * \params
	 * - filed - filed name
	 * \return value
	 */
	public function get($field)
	{
		if(ISSET($_SESSION[$this->prefix.$field]))
			return $_SESSION[$this->prefix.$field];
		return NULL;
	}
	/*! set value
	 * \params
	 * - filed - filed name
	 * - value - value
	 * \return no
	 */
	public function set($field, $value)
	{
   		$_SESSION[$this->prefix.$field]=$value;
		session_register($_SESSION[$this->prefix.$field]);
	}
}
?>
