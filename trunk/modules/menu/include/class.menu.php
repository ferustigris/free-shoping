<?php
include_once "include/iface.module.php";
//! class for menu
class Menu {//extends Template {
	private $parent;//! parent module
	private $id;//! template id
	/*! constructor
	 * \params
	 * - parent - parent module
	 * - id - root id
	 * \return no
	 */
	public function __construct(&$parent, $id)
	{
		$this->parent = $parent;
		$this->id = intval($id);
	}
	/*! get all child menus
	 * \params no
	 * \return true/false
	 */
	public function menus()
	{
		$list = Array();// = NULL;
		$priority = AUTH_NOBODY;
		if($muser = $this->parent->get_module('auth'))
		{
			if($user = $muser->get_var('user'))
			{
				$priority = $user->priority();
			}
		}
		if($db = $this->parent->db())
		{
			if($result = $db->query("SELECT
				".$db->getPrefix()."module_pages.id
				FROM
				".$db->getPrefix()."modules,
				".$db->getPrefix()."module_pages
				WHERE
				".$db->getPrefix()."module_pages.i_min_priority<=".$priority."
				AND ".$db->getPrefix()."module_pages.i_menu=1
				AND ".$db->getPrefix()."module_pages.i_max_priority>=".$priority."
				AND ".$db->getPrefix()."modules.id=".$db->getPrefix()."module_pages.id_module;"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$list[] = new Menu($this->parent, $line[0]);
				}
			}
		}
		return $list;
	}
	/*! link
	 * \params no
	 * \return text
	 */
	public function link()
	{
		if($db = $this->parent->db())
		{
			if($result = $db->query("SELECT
				".$db->getPrefix()."modules.s_name,
				".$db->getPrefix()."module_pages.s_page
				FROM
				".$db->getPrefix()."modules,
				".$db->getPrefix()."module_pages
				WHERE
				".$this->id."=".$db->getPrefix()."module_pages.id
				AND ".$db->getPrefix()."modules.id=".$db->getPrefix()."module_pages.id_module
				;"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return 'index.php?module='.$line[0].'&page='.$line[1];
				}
			}
		}
		return NULL;
	}
	/*! link title
	 * \params no
	 * \return text
	 */
	public function title()
	{
		if($db = $this->parent->db())
		{
			if($result = $db->query("SELECT
				".$db->getPrefix()."module_pages.s_description
				FROM
				".$db->getPrefix()."module_pages
				WHERE
				".$this->id."=".$db->getPrefix()."module_pages.id;"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return $this->parent->translate($line[0]);
				}
			}
		}
		return NULL;
	}
}
?>
