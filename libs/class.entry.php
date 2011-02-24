<?php
//! class - one entry
class Entry {
	private $tfield;//! field name
	private $tvalue;//! value
	/*! constructor
	 * \params
	 * - field - field name
	 * - value - value name
	 * \return no
	 */
	public function __construct($field, $value)
	{
		$this->tfield = $field;
		$this->tvalue = $value;
	}
	/*! get field name
	 * \params no
	 * \return no
	 */
	public function field()
	{
		return $this->tfield;
	}
	/*! get value name
	 * \params no
	 * \return no
	 */
	public function value()
	{
		return $this->tvalue;
	}
}
?>