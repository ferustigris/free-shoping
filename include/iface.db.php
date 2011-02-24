<?php
//! class for db access
class DB {
	/*! exec query
	 * \params
	 * - str - sql
	 * \return no
	 */
	abstract public function query($str) ;
	/*! get prefix for tables
	 * \params no
	 * \return no
	 */
	abstract public function getPrefix() ;
	/*! get free id from table
	 * \params
	 * - table - table name
	 * \return no
	 */
	abstract public function getFreeID($table) ;
}
?>
