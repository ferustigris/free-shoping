<?php
include_once "include/iface.module.php";
include_once "class.state.php";
//! class for order
class Order {
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
	/*! get child Orders
	 * \params no
	 * \return true/false
	 */
	public function child()
	{
		$list = Array();
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				".$db->getPrefix()."orders.id
				FROM
				".$db->getPrefix()."orders,
				".$db->getPrefix()."order_states
				WHERE
				id_parent=".$this->id."
				AND ".$db->getPrefix()."orders.id_state=".$db->getPrefix()."order_states.id
				AND ".$db->getPrefix()."order_states.i_code>0
				ORDER BY ".$db->getPrefix()."orders.i_date;"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$list[] = new Order($this->module, $line[0]);
				}
			}
		}
		return $list;
	}
	/*! get product
	 * \params no
	 * \return true/false
	 */
	public function product()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				id_product
				FROM
				".$db->getPrefix()."orders
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
	/*! get size
	 * \params no
	 * \return true/false
	 */
	public function size()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				id_size
				FROM
				".$db->getPrefix()."orders
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return new Size($this->module, $line[0]);
				}
			}
		}
		return new Size($this->module, -1);
	}
	/*! get state
	 * \params no
	 * \return state
	 */
	public function state()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				id_state
				FROM
				".$db->getPrefix()."orders
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return new State($this->module, $line[0]);
				}
			}
		}
		return new State($this->module, -1);
	}
	/*! get state
	 * \params
	 * id_state - new state
	 * \return no
	 */
	public function set_state($id_state)
	{
		$id_state = intval($id_state);
		if($db = $this->module->db())
		{
			if($result = $db->query("UPDATE
				".$db->getPrefix()."orders
				SET id_state=".$id_state."
				WHERE
				id=".$this->id.";"))
			{
			}
		}
	}
	/*! get user
	 * \params no
	 * \return id
	 */
	public function user()
	{
		if($db = $this->module->db())
		{
			if($userm = $this->module->get_module('auth'))
			{
				if($user = $userm->get_var('user'))
				{
					if($result = $db->query("SELECT
						id_user
						FROM
						".$db->getPrefix()."orders
						WHERE
						id=".$this->id.";"))
					{
						while( $line = mysql_fetch_array( $result ) )
						{
							return $user->user($line[0]);
						}
					}
				}
			}
		}
		return $user->user(-1);
	}
	/*! get date
	 * \params no
	 * \return seconds from 1970
	 */
	public function date()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				i_date
				FROM
				".$db->getPrefix()."orders
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return $line[0];
				}
			}
		}
		return -1;
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
				".$db->getPrefix()."orders
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					if($line[0] > -1)
						return new Order($this->module, $line[0]);
				}
			}
		}
		return new Order($this->module, -1);
	}
	/*! id
	 * \params no
	 * \return text
	 */
	public function id()
	{
		return $this->id;
	}
	/*! total price
	 * \params no
	 * \return text
	 */
	public function price()
	{
		$total_price = 0;
		$prod = $this->product();
		if(count($prod->child()) == 0)
			$total_price = $prod->price();
		foreach($this->child() as $child)
		{
			$prod = $child->product();
			if(count($prod->child()) == 0)
				$total_price += $prod->price();
		}
		return $total_price;
	}
	/*! add new category
	 * \params
	 * - id_user - user
	 * - $id_product - product
	 * - $id_size - size
	 * \return new order
	 */
	public function add($id_user, $id_product, $id_size)
	{
		$id_user = intval($id_user);
		$id_product = intval($id_product);
		$id_size = intval($id_size);
		if($db = $this->module->db())
		{
			if($state = new State($this->module, -1))
			{
				if($state = $state->get_by_code(ORDER_BEGIN))
				{
					if($result = $db->query("INSERT INTO
						".$db->getPrefix()."orders(id_parent, id_user, id_product, id_size, id_state, i_date)
						VALUES(".$this->id.", ".$id_user.", ".$id_product.", ".$id_size.", ".$state->id().", ".time().");"))
					{
						return new Order($this->module, $db->getLastId());
					}
				}
			}
		}
		return NULL;
	}
}
?>
