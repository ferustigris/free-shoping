<?php
	global $db;//! DB
	global $settings;//! settings manager
	global $modules;//! user modules list
	/*! are cite has been installed?
	 * \params no
	 * \return no
	 */
	function installed()
	{
		global $settings;//! settings manager
		include_once "libs/class.settings.php";
		$settings = new Settings("/var/www/cms/settings.php") ;
		return $settings->get('install') == true;
	}
	/*! create some globals classes
	 * \params no
	 * \return no
	 */
	function init()
	{
		global $db;//! DB
		global $settings;//! settings manager
		include_once "libs/class.database.php";
		if($db = new DataBase($settings->get("db_name"), $settings->get("db_prefix"), $settings->get("db_user"), $settings->get("db_passwd")))
		{
			if(!load_modules())
			{
				include_once "modules/install/include/class.installer.php";
				$installer = new Installer();
				$installer->load();
			}
		}
	}
	/*! load modules
	 * \params no
	 * \return no
	 */
	function load_modules()
	{
		global $db;//! DB
		global $modules;//! modules list
		include_once "libs/class.moduleentry.php";
		//load sys modules
		if($result = $db->query("SELECT id,s_name FROM ".$db->getPrefix()."modules WHERE is_active>0 ORDER BY is_active;"))
		{
			while( $line = mysql_fetch_array( $result ) )
			{
				$modules[$line[1]] = new ModuleEntry($line[0], $line[1]);
			}
		}
		//init modules
		if(ISSET($modules) )
			foreach($modules as $module)
				$module->init();
		//init modules
		/*if(ISSET($modules) )
			foreach($modules as $module)
				$module->start();

		*/
		return ISSET($modules);
	}
	/*! draw html
	 * \params no
	 * \return html code
	 */
	function html()
	{
		global $modules;//! modules list
		if(ISSET($modules['templates']))
			if($tpl = $modules['templates']->get_var('template'))
			{
				if(ISSET($_SERVER['HTTP_X_REQUESTED_WITH']))
					if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
					{
						$tpl->ajax();
						return;
					}
				$tpl->html();
			}
	}
?>
