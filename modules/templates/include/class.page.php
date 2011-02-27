<?php
//! class - template page
class Page {
	private $id;//! id Page
	private $name;//! name Page
	private $description;//! description Page
	/*! constructor
	 * \params
	 * - $id - id Page
	 * - $name - ame Page
	 * - $description - description Page
	 * \return no
	 */
	public function __construct($id, $name, $description)
	{
		$this->id = (integer)($id);
		$this->name = $name;
		$this->description = $description;
	}
	/*! get id
	 * \params no
	 * \return id
	 */
	public function id()
	{
		return $this->id;
	}
	/*! get name
	 * \params no
	 * \return name
	 */
	public function name()
	{
		return $this->name;
	}
	/*! get description
	 * \params no
	 * \return description
	 */
	public function description()
	{
		return $this->description;
	}
}
?>