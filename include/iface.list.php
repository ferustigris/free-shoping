<?php
include_once("include/iface.entry.php");
//! abstract class for lists
abstract class SimpleList {
	/*! set value
	 * \params
	 * - filed - filed name
	 * - value - value
	 * \return no
	 */
	abstract public function set($field, $value);
	/*! get value
	 * \params
	 * - filed - filed name
	 * \return no
	 */
	abstract public function get($field);
}
?>