<?php
//! class - template section
class Section {
	private $id;//! id section
	private $name;//! name section
	private $description;//! description section
	/*! constructor
	 * \params
	 * - $id - id section
	 * - $name - ame section
	 * - $description - description section
	 * \return no
	 */
	public function __construct($id, $name, $description)
	{
		$this->id = $id;
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