<?php
include_once "include/iface.module.php";
include_once "modules/categories/include/class.category.php";
include_once "libs/class.dynamiclist.php";
include_once "class.material.php";
include_once "class.producer.php";
include_once "class.size.php";
//! class for Category
class Product  extends DynamicList{
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
		$this->id = (integer)$id;
		parent::__construct("product_options", $this->id);
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
				".$db->getPrefix()."products
				WHERE
				id_product=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$list[$i++] = new Product($this->module, $line[0]);
				}
			}
		}
		return $list;
	}
	/*! get all categories
	 * \params
     * - category - category id
	 * \return true/false
	 */
	public function all($category)
	{
		$list = Array();// = NULL;
		$i = 0;
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				id
				FROM
				".$db->getPrefix()."products
                WHERE
                id_category=".$category." AND id_product=-1;"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$list[$i++] = new Product($this->module, $line[0]);
				}
			}
		}
		return $list;
	}
	/*! parent
	 * \params no
	 * \return text
	 */
	public function parent()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				id_product
				FROM
				".$db->getPrefix()."products
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return new Product($this->module, $line[0]);
				}
			}
		}
		return new Product($this->module, -1);
	}
	/*! category
	 * \params no
	 * \return text
	 */
	public function category()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				id_category
				FROM
				".$db->getPrefix()."products
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
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
		return 'index.php?module=products&page=product_page&product_id='.$this->id;
	}
	/*! id
	 * \params no
	 * \return text
	 */
	public function id()
	{
		return $this->id;
	}
	/*! add new product
	 * \params
	 * - $parent_id - root
	 * - $category_id - root
	 * \return true/false
	 */
	public function add($category_id)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("INSERT INTO
				".$db->getPrefix()."products(id_product, id_category)
				VALUES(".$this->id.", ".$category_id.");"))
			{
				$id = mysql_insert_id();
				$pr = new Product($this->module, $id);
				return $pr;
			}
		}
		return false;
	}
	/*! set material
	 * \params
	 * - $material_id - material id
	 * \return yes/no
	 */
	public function set_material($material_id)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("UPDATE
				".$db->getPrefix()."products
				SET id_material=".$material_id."
				WHERE id=".$this->id.";"))
			{
					return true;
			}
		}
		return NULL;
	}
	/*! set price
	 * \params
	 * - $price - $price
	 * \return yes/no
	 */
	public function set_price($price)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("UPDATE
				".$db->getPrefix()."products
				SET i_price=".$price."
				WHERE id=".$this->id.";"))
			{
					return true;
			}
		}
		return NULL;
	}
	/*! price of product
	 * \params no
	 * \return path
	 */
	public function price()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				i_price
				FROM
				".$db->getPrefix()."products
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array($result) )
				{
					return $line[0];
				}
			}
		}
		return 0;
	}
	/*! get material
	 * \params no
	 * \return material name
	 */
	public function material()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT ".$db->getPrefix()."product_materials.id
				FROM ".$db->getPrefix()."product_materials,
				".$db->getPrefix()."products
				WHERE ".$db->getPrefix()."product_materials.id=".$db->getPrefix()."products.id_material
				AND ".$db->getPrefix()."products.id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array($result) )
				{
					return new Material($this->module, $line[0]);
				}
			}
		}
		return new Material($this->module, -1);
	}
	/*! set producer
	 * \params
	 * - $producer_id - producer id
	 * \return yes/no
	 */
	public function set_producer($producer_id)
	{
		$producer_id = intval($producer_id);
		if($db = $this->module->db())
		{
			if($result = $db->query("UPDATE
				".$db->getPrefix()."products
				SET id_producer=".$producer_id."
				WHERE id=".$this->id.";"))
			{
					return true;
			}
		}
		return NULL;
	}
	/*! get producer
	 * \params no
	 * \return producer name
	 */
	public function producer()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT ".$db->getPrefix()."product_producers.id
				FROM ".$db->getPrefix()."product_producers,
				".$db->getPrefix()."products
				WHERE ".$db->getPrefix()."product_producers.id=".$db->getPrefix()."products.id_producer
				AND ".$db->getPrefix()."products.id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array($result) )
				{
					return new Producer($this->module, $line[0]);
				}
			}
		}
		return new Producer($this->module, -1);
	}
	/*! add size
	 * \params
	 * - $size_id - size id
	 * \return yes/no
	 */
	public function add_size($size_id)
	{
		$size_id = intval($size_id);
		if($db = $this->module->db())
		{
			if($result = $db->query("INSERT INTO
				".$db->getPrefix()."link_product_size(id_product, id_size)
				VALUES(".$this->id.", ".$size_id.");"))
			{
					return true;
			}
		}
		return NULL;
	}
	/*! get sizes
	 * \params no
	 * \return producer name
	 */
	public function sizes()
	{
		$list = Array() ;
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT id_size
				FROM
				".$db->getPrefix()."link_product_size
				WHERE
				id_product=".$this->id.";"))
			{
				while( $line = mysql_fetch_array($result) )
				{
					$list[] = new Size($this->module, $line[0]);
				}
			}
		}
		return $list;
	}
	/*! remove all sizes
	 * \params no
	 * \return no
	 */
	public function remove_sizes()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("DELETE FROM
				".$db->getPrefix()."link_product_size
				WHERE
				id_product=".$this->id.";"))
			{
				return true;
			}
		}
		return false;
	}
	/*! set producer
	 * \params
	 * - $producer_id - producer id
	 * \return yes/no
	 */
	public function set_category($category_id)
	{
		$category_id = intval($category_id);
		if($db = $this->module->db())
		{
			if($result = $db->query("UPDATE
				".$db->getPrefix()."products
				SET id_category=".$category_id."
				WHERE id=".$this->id.";"))
			{
					return true;
			}
		}
		return NULL;
	}
	/*! remove product
	 * \params no
	 * \return yes/no
	 */
	public function remove()
	{
		$this->module->log(LOG_TODO, 'move to trash');
		if($db = $this->module->db())
		{
			$db->query("DELETE FROM ".$db->getPrefix()."product_options WHERE i_link=".$this->id.";") ;
			$db->query("DELETE FROM ".$db->getPrefix()."products WHERE id=".$this->id.";") ;
			return true;
		}
		return NULL;
	}
}
?>
