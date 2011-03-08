<?php
include_once "include/iface.list.php";
//! class for manage GET data from forms
class FormsGet extends SimpleList {
	/*! constructor
	 * \params
	 * - filename - name of file
	 * \return no
	 */
	public function __construct()
	{
	}
	/*! get value by filed name
	 * \params
	 * - filed - filed name
	 * \return value
	 */
	public function get($field)
	{
		if(ISSET($_GET[$field]))
			return urlencode($_GET[$field]);
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
		$_GET[$field] = urldecode($value);
	}
}
?>
