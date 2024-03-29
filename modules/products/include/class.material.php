<?php
include_once "libs/class.dynamiclist.php";
//! class for Material
class Material extends DynamicList {
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
		parent::__construct("product_material_options", $this->id);
	}
	/*! id
	 * \params no
	 * \return int
	 */
	public function id()
	{
		return $this->id;
	}
	/*! get all materials
	 * \params no
	 * \return list
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
				".$db->getPrefix()."product_materials;"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$list[$i++] = new Material($this->module, $line[0]);
				}
			}
		}
		return $list;
	}
	/*! link
	 * \params no
	 * \return text
	 */
	public function material()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				s_material
				FROM
				".$db->getPrefix()."product_materials
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
	/*! add new materials
	 * \params
	 * - $material - material name
	 * - $description - material description
	 * \return true/false
	 */
	public function add($material)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("INSERT INTO
				".$db->getPrefix()."product_materials(s_material)
				VALUES('".$material."');"))
			{
				$id = mysql_insert_id();
				return new Material($this->module, $id);
			}
		}
		return NULL;
	}
	/*! remove materials
	 * \params no
	 * \return true/false
	 */
	public function remove()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT COUNT(*) FROM
				".$db->getPrefix()."products
				WHERE id_material=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					if($line[0] > 0)
						return false;
				}
				if(($db->query("DELETE FROM
					".$db->getPrefix()."product_material_options
					WHERE i_link=".$this->id.";"))&&($db->query("DELETE FROM
					".$db->getPrefix()."product_materials
					WHERE id=".$this->id.";")))
				{
					return true;
				}
			}
		}
		return false;
	}
}
?>
