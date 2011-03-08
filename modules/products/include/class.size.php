<?php
//! class for Material
class Size {
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
		$this->id = $id;
	}
	/*! id
	 * \params no
	 * \return int
	 */
	public function id()
	{
		return $this->id;
	}
	/*! get all sizes
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
				".$db->getPrefix()."product_sizes;"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$list[$i++] = new Size($this->module, $line[0]);
				}
			}
		}
		return $list;
	}
	/*! link
	 * \params no
	 * \return text
	 */
	public function size()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				s_size
				FROM
				".$db->getPrefix()."product_sizes
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
	/*! add new sizes
	 * \params
	 * - size - size name
	 * \return true/false
	 */
	public function add($size)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("INSERT INTO
				".$db->getPrefix()."product_sizes(s_size)
				VALUES('".$size."');"))
			{
				$id = mysql_insert_id();
				return new Size($this->module, $id);
			}
		}
		return false;
	}
	/*! remove sizes
	 * \params no
	 * \return true/false
	 */
	public function remove()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT COUNT(*) FROM
				".$db->getPrefix()."link_product_size
				WHERE id_size=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					if($line[0] > 0)
						return false;
				}
				if($result = $db->query("DELETE FROM
					".$db->getPrefix()."product_sizes
					WHERE id=".$this->id.";"))
				{
					return true;
				}
			}
		}
		return false;
	}
}
?>
