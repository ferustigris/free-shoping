<?php
//! class for Producer
class Producer {
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
	/*! get all producers
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
				".$db->getPrefix()."product_producers;"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$list[$i++] = new Producer($this->module, $line[0]);
				}
			}
		}
		return $list;
	}
	/*! producer
	 * \params no
	 * \return text
	 */
	public function producer()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				s_producer
				FROM
				".$db->getPrefix()."product_producers
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return $line[0];
				}
			}
		}
		return NULL;
	}
	/*! add new producer
	 * \params
	 * - $material - material name
	 * - $description - material description
	 * \return true/false
	 */
	public function add($producer, $description)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("INSERT INTO
				".$db->getPrefix()."product_producers(s_producer, s_description)
				VALUES('".$producer."', '".$description."');"))
			{
				$id = mysql_insert_id();
				return new Producer($this->module, $id);
			}
		}
		return false;
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
				WHERE id_producer=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					if($line[0] > 0)
						return false;
				}
				if($db->query("DELETE FROM
					".$db->getPrefix()."product_producers
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
