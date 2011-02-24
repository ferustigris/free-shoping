<?php
include_once "include/iface.list.php";
//! class for manage setting from coocies
class Cookies extends SimpleList {
	private $prefix;
	/*! constructor
	 * \params
	 * - filename - name of file
	 * \return no
	 */
	public function __construct($prefix)
	{
		$this->set('cookies_enable', true);
		$this->prefix = $prefix;
	}
	/*! destruct
	 * \params no
	 * \return no
	 */
	public function __destruct()
	{
	}
	/*! are cookies enabled?
	 * \params no
	 * \return value
	 */
	public function enable()
	{
		if(ISSET($_COOKIE['cookies_enable']))
			return $_COOKIE['cookies_enable'];
	}
	/*! get value by filed name
	 * \params
	 * - filed - filed name
	 * \return value
	 */
	public function get($field)
	{
		if(ISSET($_COOKIE[$this->prefix.$field]))
			return $_COOKIE[$this->prefix.$field];
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
   		setcookie($this->prefix.$field, $value, time() + 36000000);
	}
}
?>
