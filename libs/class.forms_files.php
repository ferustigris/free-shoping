<?php
include_once "include/iface.list.php";
include_once "libs/class.picture.php";
//! class for manage GET data from forms
class FormsFiles extends SimpleList {
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
	 * \return Picture class
	 */
	public function get($field)
	{
		if(ISSET($_FILES[$field]))
			return new Picture($_FILES[$field]['tmp_name']);
		return NULL;
	}
	/*! not used
	 * \params no
	 * \return no
	 */
	public function set($field, $value)
	{
	}
}
?>
