<?php
include_once "include/iface.module.php";
include_once "libs/class.dynamiclist.php";
//! class for Category
class Category extends DynamicList{
	private $module;//! parent module
	private $id;//! template id
	/*! constructor
	 * \params
	 * - parent - parent module
	 * - id - root id
	 * \return no
	 */
	public function __construct(&$parent, $id)
	{
		$this->module = $parent;
		$this->id = intval($id);
		parent::__construct("category_options", $this->id);
	}
	/*! get child categories
	 * \params no
	 * \return true/false
	 */
	public function child()
	{
		$list = Array();// = NULL;
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				id
				FROM
				".$db->getPrefix()."categories
				WHERE
				id_parent=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$list[] = new Category($this->module, $line[0]);
				}
			}
		}
		return $list;
	}
	/*! get all categories
	 * \params no
	 * \return true/false
	 */
	public function all()
	{
		$list = Array();// = NULL;
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				id
				FROM
				".$db->getPrefix()."categories;"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$list[] = new Category($this->module, $line[0]);
				}
			}
		}
		return $list;
	}
	/*! get parent category
	 * \params no
	 * \return parent
	 */
	public function get_parent()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				id_parent
				FROM
				".$db->getPrefix()."categories
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					if($line[0] > -1)
						return new Category($this->module, $line[0]);
				}
			}
		}
		return new Category($this->module, -1);
	}
	/*! link to categories
	 * \params no
	 * \return url
	 */
	public function link()
	{
		return 'index.php?module=categories&page=categories_list&category_id='.$this->id;
	}
	/*! id
	 * \params no
	 * \return text
	 */
	public function id()
	{
		return $this->id;
	}
	/*! add new category
	 * \params
	 * - $parent_id - root
	 * \return new category object
	 */
	public function add($parent_id)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("INSERT INTO
				".$db->getPrefix()."categories(id_parent)
				VALUES(".$parent_id.");"))
			{
				return new Category($this->module, $db->getLastId());
			}
		}
		return NULL;
	}
}
?>
