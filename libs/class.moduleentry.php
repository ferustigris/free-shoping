<?php
include_once "include/iface.module.php";
include_once "include/iface.log.php";
include_once "include/iface.user.php";
include_once "libs/class.cookies.php";
include_once "libs/class.dynamiclist.php";
include_once "libs/class.forms_get.php";
include_once "libs/class.forms_post.php";
include_once "libs/class.forms_files.php";
include_once "libs/class.sessions.php";
//! class for modules
class ModuleEntry extends Module {
	private $name;//! module name
	private $db_options;//! db settings
	private $forms_files;//! data of FILE-forms
	private $forms_get;//! data of GET-forms
	private $forms_post;//! data of POST-forms
	private $cookies;//! cookies
	private $sessions;//! sessions
	private $id;//! id of module
	private $vars;//! variables
	/*! constructor
	 * \params
	 * - name - module name
	 * - value - value
	 * \return no
	 */
	public function __construct($id, $name)
	{
		$this->forms_get = new FormsGet();
		$this->forms_post = new FormsPost();
		$this->forms_files = new FormsFiles();
		$this->name = $name;
		$this->id = $id;
		$this->cookies = new Cookies($name);
		$this->sessions = new Sessions($name);
		$this->db_options = new DynamicList("module_settings", $this->id);
	}
	/*! access to variables
	 * \params
	 * - var_name - name
	 * \return no
	 */
	public function get_var($var_name)
	{
		if(!ISSET($this->vars[$var_name]))
			return NULL;
		return $this->vars[$var_name];
	}
	/*! access to variables
	 * \params
	 * - var_name - name
	 * - var_value - value
	 * \return no
	 */
	public function set_var($var_name, $var_value)
	{
		$this->vars[$var_name] = $var_value;
	}
	/*! access to cookies
	 * \params no
	 * \return no
	 */
	public function cookies()
	{
		return $this->cookies;
	}
	/*! access to sessions
	 * \params no
	 * \return no
	 */
	public function sessions()
	{
		return $this->sessions;
	}
	/*! access to db options
	 * \params no
	 * \return no
	 */
	public function db_options()
	{
		return $this->db_options;
	}
	/*! access to db
	 * \params no
	 * \return no
	 */
	public function db()
	{
		if(ISSET($GLOBALS['db']))
			return $GLOBALS['db'];
		else
			return NULL;
	}
	/*! access to concrete module
	 * \params
         * - module_name - module name
	 * \return no
	 */
	public function get_module($module_name)
	{
		global $modules;
        if(ISSET($modules[$module_name]))
             return $modules[$module_name];
        else
             return NULL;
	}
	/*! access to data of GET-forms
	 * \params no
	 * \return no
	 */
	public function forms_get()
	{
		return $this->forms_get;
	}
	/*! access to data of FILE-forms
	 * \params no
	 * \return no
	 */
	public function forms_files()
	{
		return $this->forms_files;
	}
	/*! access to data of POST-forms
	 * \params no
	 * \return no
	 */
	public function forms_post()
	{
		return $this->forms_post;
	}
	/*! translate
	 * \params
	 * - source - source text
	 * \return translated text
	 */
	public function translate($source)
	{
		if($this->get_module('languages'))
		{
			if($this->get_module('languages')->get_var('lang'))
				return $this->get_module('languages')->get_var('lang')->translate($source);
		}
		return $source;
	}
	/*! get module name
	 * \params no
	 * \return no
	 */
	public function name()
	{
		return $this->name;
	}
	/*! add msg to log
	 * \params
	 * - level - log level
	 * - msg - log msg
	 * \return no
	 */
	public function log($level, $msg)
	{
		if($this->get_module('log'))
		{
			$log = $this->get_module('log')->get_var('log');
			if(ISSET($log))
			{
				$log->add($level, $this->name, $msg);
			}
		}
	}
	/*! load page
	 * \params
	 * - page - page name
	 * \return no
	 */
	public function load($page)
	{
		$this->log(LOG_DEBUG, __METHOD__.': '.__LINE__);
		$i_priority = AUTH_NOBODY;

		if($this->get_module('auth'))
		{
			if($user = $this->get_module('auth')->get_var('user'))
				$i_priority = $user->priority();
		}
		if($result = $this->db()->query("SELECT COUNT(*) FROM ".$this->db()->getPrefix()."module_pages "
				." WHERE s_page = '".$page."' "
				." AND id_module=".$this->id
				." AND i_min_priority<=".$i_priority
				." AND i_max_priority>=".$i_priority.";"))
		{
			while( $line = mysql_fetch_array( $result ) )
			{
				if($line[0] > 0)
                {
                	if(file_exists("modules/".$this->name() ."/pages/page.".$page.".php") )
                	{
                		try {
                			include "modules/".$this->name() ."/pages/page.".$page.".php";
                			return true;
                		} catch(Exception $e) {
                			$this->log(LOG_ERROR, 'Exception exec page '.$page);
                			return false;
                		}
                	}
                	else
                		$this->log(LOG_ERROR, 'Page not found '.$page);
                }
			}
		}
		$this->log(LOG_DEBUG, $this->translate('Your can not view page').' '.$page);
        return false;
	}
	/*! load action
	 * \params
	 * - action - what to do?
	 * \return no
	 */
	public function action($action)
	{
		$this->log(LOG_DEBUG, __METHOD__.': '.__LINE__);
		$i_priority = AUTH_NOBODY;
		if($this->get_module('auth'))
		{
			$i_priority = $this->get_module('auth')->get_var('user')->priority();
		}
		if($result = $this->db()->query("SELECT COUNT(*) FROM ".$this->db()->getPrefix()."module_actions "
				." WHERE s_action = '".$action."' "
				." AND id_module=".$this->id
				." AND i_min_priority<=".$i_priority
				." AND i_max_priority>=".$i_priority.";"))
		{
			while( $line = mysql_fetch_array( $result ) )
			{
				if($line[0] > 0)
				{
					if(file_exists("modules/".$this->name() ."/actions/action.".$action.".php") )
					{
                		try {
                			include "modules/".$this->name() ."/actions/action.".$action.".php";
                			return true;
                		} catch(Exception $e) {
                			$this->log(LOG_ERROR, 'Exception exec page '.$action);
                			return false;
                		}
					}
					else
						$this->log(LOG_ERROR, 'no found action handler '.$action);
				}
			}
		}
		return false;
	}
	/*! init module
	 * \params no
	 * \return no
	 */
	public function init()
	{
		$this->log(LOG_DEBUG, __METHOD__.': '.__LINE__);
		$this->log(LOG_DEBUG, 'init '.$this->name());
		if(file_exists("modules/".$this->name() ."/include/init.php") )
			include "modules/".$this->name() ."/include/init.php";
		else
			$this->log(LOG_ERROR, 'no found init.php');
	}
	/*! get url of template file
	 * \params
	 * - template - template name
	 * \return url
	 */
	public function add_tpl($template)
	{
		if($this->get_module('templates'))
		{
			$tpl = $this->get_module('templates')->get_var('template');
			if(ISSET($tpl))
			{
				return $tpl->add_tpl($this->name, $template);
			}
		}
		return NULL;
	}
	/*! get url of ajax-template file
	 * \params
	 * - template - template name
	 * \return url
	 */
	public function add_ajax_tpl($template)
	{
		if($this->get_module('templates'))
		{
			$tpl = $this->get_module('templates')->get_var('template');
			if(ISSET($tpl))
			{
				return $tpl->add_ajax_tpl($this->name, $template);
			}
		}
		return NULL;
	}
	/*! assign variable in smarty
	 * \params
	 * - variable - variable in template
	 * - value - her value
	 * \return url
	 */
	public function assign($variable, $value)
	{
	 	if($templates = $this->get_module('templates'))
		{
			if($tpl = $this->get_module('templates')->get_var('template'))
			{
				$tpl->assign($this->name(), $variable, $value);
			}
			else $this->log(LOG_ERROR, 'Cant find template');
		}
		else $this->log(LOG_ERROR, 'Cant find template module');
	}
}
?>
