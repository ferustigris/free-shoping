<?php
include_once "include/iface.module.php";
include_once "modules/categories/include/class.category.php";
include_once "class.material.php";
include_once "class.producer.php";
include_once "class.size.php";
//! class for Category
class Product {
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
	/*! product
	 * \params no
	 * \return text
	 */
	public function product()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				s_product
				FROM
				".$db->getPrefix()."products
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
	/*! article
	 * \params no
	 * \return text
	 */
	public function article()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				s_article
				FROM
				".$db->getPrefix()."products
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
	/*! description
	 * \params no
	 * \return text
	 */
	public function description()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				s_description
				FROM
				".$db->getPrefix()."products
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
	 * - $name - category name
	 * - $description - category description
	 * - $img_full - full img
	 * - $img_small - small img
	 * \return true/false
	 */
	public function add($category_id, $article, $name, $description, $img_full, $img_small)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("INSERT INTO
				".$db->getPrefix()."products(id_product, id_category, s_article, s_product, s_description)
				VALUES(".$this->id.", ".$category_id.", '".$article."', '".$name."', '".$description."');"))
			{
				$id = mysql_insert_id();
					$pr = new Product($this->module, $id);
					$pr->set_images($img_full, $img_small) ;
					return $pr;
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
				".$db->getPrefix()."product_images
				WHERE
				id_product=".$this->id.";"))
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
				".$db->getPrefix()."product_images
				WHERE
				id_product=".$this->id.";"))
			{
				while( $line = mysql_fetch_array($result) )
				{
					return urldecode($line[0]);
				}
			}
		}
		return NULL;
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
	/*! set producer
	 * \params
	 * - $producer_id - producer id
	 * \return yes/no
	 */
	public function set_description($description)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("UPDATE
				".$db->getPrefix()."products
				SET s_description='".$description."'
				WHERE id=".$this->id.";"))
			{
					return true;
			}
		}
		return NULL;
	}
	/*! set product name
	 * \params
	 * - $name - product name
	 * \return yes/no
	 */
	public function set_name($name)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("UPDATE
				".$db->getPrefix()."products
				SET s_product='".$name."'
				WHERE id=".$this->id.";"))
			{
					return true;
			}
		}
		return NULL;
	}
	/*! set product article
	 * \params
	 * - article - product article
	 * \return yes/no
	 */
	public function set_article($article)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("UPDATE
				".$db->getPrefix()."products
				SET s_article='".$article."'
				WHERE id=".$this->id.";"))
			{
					return true;
			}
		}
		return NULL;
	}
	/*! set images
	 * \params
	 * - $img_full - full img
	 * - $img_small - small img
	 * \return yes/no
	 */
	public function set_images($img_full, $img_small)
	{
		if($db = $this->module->db())
		{
			$db->query("DELETE FROM ".$db->getPrefix()."product_images WHERE id_product=".$this->id.";") ;
			if($result = $db->query("INSERT INTO
					".$db->getPrefix()."product_images(id_product, s_full_img, s_small_img)
					VALUES(".$this->id.", '".$img_full."', '".$img_small."');"))
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
			$db->query("DELETE FROM ".$db->getPrefix()."product_images WHERE id_product=".$this->id.";") ;
			$db->query("DELETE FROM ".$db->getPrefix()."products WHERE id=".$this->id.";") ;
			return true;
		}
		return NULL;
	}
}
?>
