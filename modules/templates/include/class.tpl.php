<?php
//include_once "include/iface.template.php";
//! class for modules
class Tpl {//extends Template {
	private $s_name;//! template name
	private $parent;//! parent module
	private $id;//! template id
	private $tmp_page;//! temporary variable
	private $smarty;//! link to smarty
	private $section;//! current section
	private $modules;//! modules list
	private $ajax_modules;//! modules list
	/*! constructor
	 * \params
	 * - parent - parent module
	 * - name - module name
	 * \return no
	 */
	public function __construct(&$parent, $name)
	{
		$this->s_name = $name;
		$this->parent = $parent;
		$this->ajax_modules = Array() ;
		$this->id = 1;
		require('modules/templates/smarty/Smarty.class.php');
		$this->smarty = new Smarty;
		$smarty->force_compile = true;
		$this->smarty->debugging = false;
		$this->smarty->caching = false;
		$this->smarty->cache_lifetime = 120;

		$this->smarty->setTemplateDir('templates/'.$this->s_name);
		$this->smarty->setCompileDir('modules/templates/compiled');
		$this->smarty->setCacheDir('modules/templates/cache');
		$this->smarty->setConfigDir('templates/default/configs');
	}
	/*! access to smarty
	 * \params no
	 * \return link to smarty objects
	 */
	public function smarty()
	{
		return $this->smarty;
	}
	/*! assign variable to smarty
	 * \params
	 * - var_name = var name
	 * - value - var value
	 * - module - module name
	 * \return no
	 */
	public function assign($module, $var_name, $value)
	{
		return $this->smarty->assign($module.'_'.$var_name, $value);
	}
	/*! template name
	 * \params no
	 * \return no
	 */
	public function name()
	{
		return $this->s_name;
	}
	/*! load main page
	 * \params no
	 * \return html
	 */
	public function html()
	{
		$this->css();
		$this->js();
		$this->loadActions() ;
		$this->loadModules() ;
		$this->assign('TPL', 'modules', $this->modules);
		$this->smarty->display("tpl.index.html");
	}
	/*! load ajax page
	 * \params no
	 * \return html
	 */
	public function ajax()
	{
		header('Content-Type: text/javascript; charset=utf-8');
		$this->loadActions() ;
		$this->load_concrete_module() ;
		$this->assign('TPL', 'ajax_modules', $this->ajax_modules);
		$this->smarty->display("ajax.index.xml");
	}
	/*! get all css tables
	 * \params no
	 * \return no
	 */
	private function css()
	{
		$css = NULL;
		$i = 0;
		$directory = 'styles/'.$this->name();
		if(file_exists($directory))
		{
			$dir = opendir($directory);
			while(($file = readdir($dir)))
			{
				if ( is_file ($directory."/".$file)&&strpos($file,'.css'))
				{
					if(strpos($file, '.css') > 0)
						$css[$i++] = $directory."/".$file;
				}
			}
			closedir ($dir);
		}
		global $modules;
		foreach($modules as $module)
		{
			$directory = 'styles/'.$this->name().'/'.$module->name();
			if(!file_exists($directory))continue;
			$dir = opendir($directory);
			while(($file = readdir($dir)))
			{
				if ( is_file ($directory."/".$file)&&strpos($file,'.css'))
				{
					$css[$i++] = $directory."/".$file;
				}
			}
			closedir ($dir);
		}
		$this->assign('TPL', 'css', $css);
	}
	/*! get all js scripts
	 * \params no
	 * \return no
	 */
	private function js()
	{
		$css = NULL;
		$i = 0;
		$directory = 'scripts/'.$this->name();
		if(file_exists($directory))
		{
			$dir = opendir($directory);
			while(($file = readdir($dir)))
			{
				if ( is_file ($directory."/".$file)&&strpos($file,'.js'))
				{
					$css[$i++] = $directory."/".$file;
				}
			}
			closedir ($dir);
		}
		global $modules;
		foreach($modules as $module)
		{
			$directory = 'scripts/'.$this->name().'/'.$module->name();
			if(!file_exists($directory))continue;
			$dir = opendir($directory);
			while(($file = readdir($dir)))
			{
				if ( is_file ($directory."/".$file)&&strpos($file,'.js'))
				{
					$css[$i++] = $directory."/".$file;
				}
			}
			closedir ($dir);
		}
		$this->assign('TPL', 'js', $css);
	}
	/*! load concrete pages
	 * \params no
	 * \return no
	 */
	private function load_concrete_module()
	{
		global $db;
		//load selected sections
		$module = $this->parent->forms_get()->get('module');
		$page = $this->parent->forms_get()->get('page');
		$this->smarty->assign('Name', '');
		$query = "SELECT s_section
			FROM
			".$db->getPrefix()."tpl_sections
			 WHERE
			 id_tpl=".$this->id."
			 AND is_main>0;";
		$is_main_shown = false;
		if($module&&$page)
		{
			if($result = $db->query($query))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					global $modules;
					if(ISSET($modules[$module]))
					{
						$this->section = $line[0];
						$is_main_shown = true;
						$modules[$module]->load($page);
						$this->smarty->assign('Name', ' - '.$page);
						break;
					}
				}
			}
		}
		return $is_main_shown;
	}
	/*! load pages
	 * \params no
	 * \return no
	 */
	private function loadModules()
	{
		global $db;
		//if($module&&$page)
		{
			if($result = $db->query("SELECT
				s_section, is_main
				FROM
				".$db->getPrefix()."tpl_sections WHERE
				id_tpl=".$this->id.";"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					global $modules;
					$this->section = $line[0];
					if(!ISSET($this->modules[$this->section]))
						$this->modules[$this->section] = Array() ;
					/*if($line[1] > 0)
						if(ISSET($modules[$module]))
							$modules[$module]->load($page);
							*/
				}
			}
		}
		$is_main_shown = $this->load_concrete_module() ;
		//load all sections
		$query = "SELECT
			".$db->getPrefix()."modules.s_name,
			".$db->getPrefix()."module_pages.s_page,
			".$db->getPrefix()."tpl_sections.s_section,
			".$db->getPrefix()."tpl_sections.is_main
			FROM
			".$db->getPrefix()."modules,
			".$db->getPrefix()."module_pages,
			".$db->getPrefix()."tpl_show_pages,
			".$db->getPrefix()."tpl_sections
			 WHERE
			".$db->getPrefix()."modules.id=".$db->getPrefix()."module_pages.id_module
			AND ".$db->getPrefix()."module_pages.id=".$db->getPrefix()."tpl_show_pages.id_page
			AND ".$db->getPrefix()."tpl_show_pages.id_section=".$db->getPrefix()."tpl_sections.id
			AND ".$db->getPrefix()."tpl_sections.id_tpl=".$this->id.";";
		if($result = $db->query($query))
		{
			while( $line = mysql_fetch_array( $result ) )
			{
				global $modules;
				if(ISSET($modules[$line[0]]))
				{
					$this->section = $line[2];
					if(!$is_main_shown||!$line[3]>0)
					{
						$modules[$line[0]]->load($line[1]);
					}
				}
			}
		}
		return false;
	}
	/*! exec actions
	 * \params no
	 * \return no
	 */
	private function loadActions()
	{
		global $db;
		$module = $this->parent->forms_get()->get('module');
		$action = $this->parent->forms_get()->get('action');
		if($module&&$action)
		{
			if($result = $db->query("SELECT COUNT(*) FROM
				".$db->getPrefix()."modules,
				".$db->getPrefix()."module_actions
				 WHERE
				".$db->getPrefix()."modules.id=".$db->getPrefix()."module_actions.id_module
				AND ".$db->getPrefix()."modules.s_name='".$module."'
				AND ".$db->getPrefix()."module_actions.s_action='".$action."';"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					global $modules;
					if($line[0] > 0)
						return $modules[$module]->action($action);
				}
			}
		}
		return false;
	}
	/*! add template url
	 * \params
	 * - module - module name
	 * - page - page name
	 * \return url
	 */
	public function add_tpl($module, $page)
	{
		$this->modules[$this->section][] = "modules/".$module."/tpl.".$page.".html";
	}
	/*! add ajax-template url
	 * \params
	 * - module - module name
	 * - page - page name
	 * \return url
	 */
	public function add_ajax_tpl($module, $page)
	{
		$this->ajax_modules[] = "modules/".$module."/tpl.".$page.".html";
	}
	/*! return all avaible sections
	 * \params no
	 * \return list of sections
	 */
	public function get_avaible_sections()
	{
		include_once("libs/class.section.php");
		global $db;
		$sections = NULL;
		if($result = $db->query("SELECT id, s_section FROM
			".$db->getPrefix()."tpl_sections
			WHERE
			id_tpl=".$this->id.";"))
		{
			while( $line = mysql_fetch_array( $result ) )
			{
				$sections[$line[1]] = new Section($line[0], $line[1], '');
			}
		}
		return $sections;
	}
	/*! return all avaible pages
	 * \params no
	 * \return list of sections
	 */
	public function get_avaible_pages()
	{
		include_once("libs/class.section.php");
		global $db;
		$pages = NULL;
		if($result = $db->query("SELECT ".$db->getPrefix()."module_pages.id, s_page, s_description FROM
			".$db->getPrefix()."module_pages, ".$db->getPrefix()."modules
			WHERE
			".$db->getPrefix()."modules.id=".$db->getPrefix()."module_pages.id_module
			AND is_active>0;"))
		{
			while( $line = mysql_fetch_array( $result ) )
			{
				$pages[$line[1]] = new Section($line[0], $line[1], $line[2]);
			}
		}
		return $pages;
	}
	/*! set show page in section
	 * \params
	 * - id_section - section id
	 * - id_page - page id
	 * \return true/false
	 */
	public function set_page_in_section($id_section, $id_page)
	{
		global $db;
		//$this->remove_page_in_section($id_page);
		if($result = $db->query("INSERT INTO ".$db->getPrefix()."tpl_show_pages(id_page, id_section)
			VALUES (".$id_page.', '.$id_section.') ;'))
		{
			return true;
		}
		return false;
	}
	/*! remove(hide) shown page in section
	 * \params
	 * - id_page - page id
	 * \return true/false
	 */
	public function remove_page_in_section($id_page)
	{
		global $db;
		return $db->query("DELETE FROM ".$db->getPrefix()."tpl_show_pages
		WHERE id_page=".$id_page.";") ;
	}
}
?>
