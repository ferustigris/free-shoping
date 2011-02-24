<?php
include_once "include/iface.list.php";
//! class for manage GET data from forms
class FormsPost extends SimpleList {
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
		if(ISSET($_POST[$field]))
			return $_POST[$field];
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
		$_POST[$field] = $value;
	}
}
?>
