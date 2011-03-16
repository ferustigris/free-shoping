<?php
	//include_once "include/iface.installer.php";
	include_once "libs/class.cookies.php";
	include_once "libs/class.forms_get.php";
	include_once "libs/class.forms_post.php";
	//! class for install
	class Installer// extends Install
	{
		private $module_id;
		private $activity;
		/*! create Installer
		 * \params no
		 * \return no
		 */
		public function __construct()
		{
			$this->module_id = -1;
			$this->activity = 1;
		}
		/*! create user
		 * \params no
		 * \return no
		 */
		public function __destruct()
		{
		}
		/*! set module prio
		 * \params
		 * - activity - 1 for sys modules, 2 for user modules
		 * \return no
		 */
		public function setActivity($activity)
		{
			$this->activity = $activity;
		}
		/*! modules list
		 * \params no
		 * \return list
		 */
		public function modules()
		{
			global $db;
            $list = Array();
			if(ISSET($db))
			{
				if($result = $db->query("SELECT id, s_name FROM ".$db->getPrefix()."modules;"))
				{
                    while( $line = mysql_fetch_array( $result ) )
                    {
                        $list[] = new ModuleEntry($line[0], $line[1]);
                    }
				}
			}
			return $list;
		}
		/*! add module page
		 * \params
		 * - $min_priority - page min
		 * - $max_priority - page max
		 * - $page - page name
		 * - $description - page description
		 * - menu - are avaible by menu?
		 * \return no
		 */
		public function addPage($page, $min_priority, $max_priority, $description, $menu)
		{
			global $db;
			if(ISSET($db))
			{
				if($result = $db->query("INSERT INTO ".$db->getPrefix()."module_pages
					(id_module, i_min_priority, i_max_priority, s_page, s_description, i_menu)
					VALUES(".$this->module_id.",".$min_priority.",".$max_priority.",'".$page."','".$description."', ".$menu.");"))
				{
					return true;
				}
			}
			return false;
		}
		/*! add module action
		 * \params
		 * - $min_priority - action min
		 * - $max_priority - action max
		 * - $page - action name
		 * - $description - action description
		 * \return no
		 */
		public function addAction($action, $min_priority, $max_priority, $description)
		{
			global $db;
			if(ISSET($db))
			{
				if($result = $db->query("INSERT INTO
					".$db->getPrefix()."module_actions
					(id_module, i_min_priority, i_max_priority, s_action, s_description)
					VALUES(".$this->module_id.",".$min_priority.",".$max_priority.",'".$action."','".$description."');"))
				{
					return true;
				}
			}
			return false;
		}
		/*! parse&exec sql script
		 * \params
		 * - sql - sql script
		 * \return no
		 */
		public function execSQL($sql)
		{
			global $db;
			if(ISSET($db))
			{
				$r=fopen($sql,'r'); // 2
				$text=fread($r,filesize($sql)); // 3
				fclose($r);  // 4
				$text = str_replace('DB', $db->getDBName(), $text);
				$text = str_replace('PREFIX', $db->getPrefix(), $text);
				return $db->query($text);
			}
			return false;
		}
		/*! uninstall module
		 * \params
		 * - module - module name
		 * \return no
		 */
		public function uninstall($module)
		{
			global $db;
			if($result = $db->query("SELECT id FROM ".$db->getPrefix()."modules WHERE s_name='".$module."';"))
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$db->query("DELETE FROM ".$db->getPrefix()."modules WHERE id=".$line[0].";");
					$db->query("DELETE FROM ".$db->getPrefix()."module_pages WHERE id_module=".$line[0].";");
					$db->query("DELETE FROM ".$db->getPrefix()."module_actions WHERE id_module=".$line[0].";");
					return true;
				}
			}
			return false;
		}
		/*! install unpack module
		 * \params
		 * - module - module name
		 * - $description - module description
		 * \return no
		 */
		public function install($module, $description)
		{
			$directory = 'modules/'.$module.'/install/sql';
			if(file_exists($directory))
			{
				$dir = opendir($directory);
				while(($file = readdir($dir)))
				{
					if ( is_file ($directory."/".$file))
					{
						if(strpos($file, '.sql') > 0)
							$this->execSQL($directory."/".$file);
					}
				}
				closedir ($dir);
			}
			global $db;
			if(ISSET($db))
			{
				$db->query("INSERT INTO ".$db->getPrefix()."modules(is_active, s_name)
				VALUES(".$this->activity.", '".$module."');");
				if($result = $db->query("SELECT id FROM ".$db->getPrefix()."modules WHERE s_name='".$module."';"))
				{
					while( $line = mysql_fetch_array( $result ) )
					{
						$this->module_id = $line[0];
						if(file_exists('modules/'.$module.'/install/install.php'))
							require('modules/'.$module.'/install/install.php');
						else
							return false;
						return true;
					}
				}
			}
			return false;
		}
		/*! load body
		 * \params no
		 * \return no
		 */
		public function load()
		{
			global $settings;//! settings manager
			include_once "libs/class.sessions.php";
			$cook = new Sessions('auth');
			$get = new FormsGet();
			$post = new FormsPost();
			$settings->set('install', false);
			if($post->get('language'))
				$settings->set('language', $post->get('language'));
			if($post->get('db_user'))
				$settings->set('db_user', $post->get('db_user'));
			if($post->get('db_name'))
				$settings->set('db_name', $post->get('db_name'));
			if($post->get('db_passwd'))
				$settings->set('db_passwd', $post->get('db_passwd'));
			if($post->get('db_prefix'))
				$settings->set('db_prefix', $post->get('db_prefix'));
			if($post->get('password'))
				$cook->set('password', sha1($post->get('password')));
			if($post->get('login'))
				$cook->set('login', $post->get('login'));
			if($get->get('page') == 'complite')
			{
				/*DROP TABLE `PREFIXcategories`, `PREFIXlink_product_size`, `PREFIXmessages`, `PREFIXmodules`, `PREFIXmodule_actions`, `PREFIXmodule_pages`, `PREFIXmodule_settings`, `PREFIXorders`, `PREFIXorder_states`, `PREFIXproducts`, `PREFIXproduct_images`, `PREFIXproduct_materials`, `PREFIXproduct_producers`, `PREFIXproduct_sizes`, `PREFIXtemplates`, `PREFIXtpl_sections`, `PREFIXtpl_show_pages`, `PREFIXusers`, `PREFIXuser_options`;*/
				foreach($_POST as $line => $key)
					if($key == 'module')
						$this->install($line, '').'<br />';
				include_once "modules/auth/include/class.user.php";
				UserImpl::new_user($cook->get('login'), $cook->get('password'), 9);
				$settings->set('install', true);
				$settings->save();
				setcookie('redirect', '', time() + 36000000);
			}
			if(!$get->get('page'))//первый раз
				include 'templates/default/install/tpl.welcome.php';
			else
			{
				if(file_exists('templates/default/install/tpl.'.$get->get('page').'.php'))
					include 'templates/default/install/tpl.'.$get->get('page').'.php';
				else
				{
					Header('index.php');
					return false;
				}
			}
		}
	}
?>
