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
		$this->id = (integer)$id;
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
	/*! return all avaible pages
	 * \params no
	 * \return list of sections
	 */
	public function pages()
	{
		include_once("class.page.php");
		global $db;
		$pages = Array();
		if($result = $db->query("SELECT ".$db->getPrefix()."module_pages.id, s_page, s_description FROM
			".$db->getPrefix()."module_pages, ".$db->getPrefix()."tpl_show_pages
			WHERE
			".$db->getPrefix()."module_pages.id=".$db->getPrefix()."tpl_show_pages.id_page
			AND ".$this->id."=".$db->getPrefix()."tpl_show_pages.id_section;"))
		{
			while( $line = mysql_fetch_array( $result ) )
			{
				$pages[$line[1]] = new Page($line[0], $line[1], $line[2]);
			}
		}
		return $pages;
	}
	/*! return free avaible pages
	 * \params no
	 * \return list of sections
	 */
	public function free_pages()
	{
		include_once("class.page.php");
		global $db;
		$pages = Array();
		if($result = $db->query("SELECT ".$db->getPrefix()."module_pages.id, ".$db->getPrefix()."module_pages.s_page
			FROM ".$db->getPrefix()."module_pages
			LEFT JOIN ".$db->getPrefix()."tpl_show_pages ON
			".$db->getPrefix()."tpl_show_pages.id_page=".$db->getPrefix()."module_pages.id
			WHERE ".$db->getPrefix()."tpl_show_pages.id_page is NULL;"))
		{
			while( $line = mysql_fetch_array( $result ) )
			{
				$pages[$line[1]] = new Page($line[0], $line[1], '');
			}
		}
		return $pages;
	}
	/*SELECT PREFIXmodule_pages.id FROM PREFIXmodule_pages
LEFT JOIN PREFIXtpl_show_pages ON PREFIXtpl_show_pages.id_page=PREFIXmodule_pages.id
WHERE PREFIXtpl_show_pages.id_page is NULL*/
}
?>