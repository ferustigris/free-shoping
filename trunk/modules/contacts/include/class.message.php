<?php
include_once "include/iface.module.php";
//! class for Messages
class MessageBody {
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
	/*! get child Messages
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
				".$db->getPrefix()."messages
				WHERE
				id_parent=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$list[] = new MessageBody($this->module, $line[0]);
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
				".$db->getPrefix()."messages
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					if($line[0] > -1)
						return new MessageBody($this->module, $line[0]);
				}
			}
		}
		return new MessageBody($this->module, -1);
	}
	/*! body
	 * \params no
	 * \return text
	 */
	public function body()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				s_message
				FROM
				".$db->getPrefix()."messages
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
	/*! body
	 * \params no
	 * \return text
	 */
	public function user()
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("SELECT
				id_user
				FROM
				".$db->getPrefix()."messages
				WHERE
				id=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					if($mod_auth = $this->module->get_module('auth'))
						if($user = $mod_auth->get_var('user'))
							return $user->user($line[0]);
				}
			}
		}
		return NULL;
	}
	/*! add new messages
	 * \params
	 * - $parent_id - root
	 * - $messages - message
	 * \return true/false
	 */
	public function add($parent_id, $user_id, $message)
	{
		if($db = $this->module->db())
		{
			if($result = $db->query("INSERT INTO
				".$db->getPrefix()."messages(id_parent, id_user, s_message)
				VALUES(".$parent_id.", ".$user_id.", '".$message."');"))
			{
				return true;
			}
		}
		return false;
	}
}
?>
