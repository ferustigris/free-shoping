<?php
include_once "include/iface.module.php";
//! class for Category
class Category {
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
	}
	/*! get child categories
	 * \params no
	 * \return true/false
	 */
	public function child()
	{
		$list = Array();// = NULL;
		$i = 0;
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
					$list[$i++] = new Category($this->module, $line[0]);
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
		$i = 0;
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				id
				FROM
				".$db->getPrefix()."categories;"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$list[$i++] = new Category($this->module, $line[0]);
				}
			}
		}
		return $list;
	}
	/*! get parent
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
	/*! link
	 * \params no
	 * \return text
	 */
	public function title()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				s_category
				FROM
				".$db->getPrefix()."categories
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return urldecode($line[0]);
				}
			}
		}
		return NULL;
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
	 * - $name - category name
	 * - $description - category description
	 * - $img_full - full img
	 * - $img_small - small img
	 * \return true/false
	 */
	public function add($parent_id, $name, $description, $img_full, $img_small)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("INSERT INTO
				".$db->getPrefix()."categories(id_parent, s_category, s_description, s_full_img, s_small_img)
				VALUES(".$parent_id.", '".$name."', '".$description."', '".$img_full."', '".$img_small."');"))
			{
				return true;
			}
		}
		return false;
	}
	/*! path to full image
	 * \params no
	 * \return path
	 */
	public function img()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				s_full_img
				FROM
				".$db->getPrefix()."categories
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return urldecode($line[0]);
				}
			}
		}
		return NULL;
	}
	/*! path to small image
	 * \params no
	 * \return path
	 */
	public function small_img()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				s_small_img
				FROM
				".$db->getPrefix()."categories
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return urldecode($line[0]);
				}
			}
		}
		return NULL;
	}
}
?>
