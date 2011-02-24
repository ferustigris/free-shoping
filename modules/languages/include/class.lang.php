<?php
include_once "include/iface.language.php";
//! class for modules
class Lang extends Language {
	private $lang;//! current language
	private $data;//! data table
	/*! constructor
	 * \params
	 * - name - module name
	 * - value - value
	 * \return no
	 */
	public function __construct($lang)
	{
		$this->lang = $lang;
	}
	/*! load all
	 * \params no
	 * \return no
	 */
	public function load()
	{
		$directory = 'languages/'.$this->lang;
		if(file_exists($directory))
		{
			$dir = opendir($directory);
			while(($file = readdir($dir)))
			{
				if ( is_file ($directory."/".$file))
				{
					if((strpos($file, '.php') > 0))
						require $directory."/".$file;
				}
			}
			closedir ($dir);
		}
		global $modules;
		if(ISSET($modules))
		{
			foreach($modules as $module)
			{
				$directory = 'languages/'.$this->lang.'/'.$module->name();
				if(!file_exists($directory))continue;
				$dir = opendir($directory);
				while(($file = readdir($dir)))
				{
					if ( is_file ($directory."/".$file))
					{
						if((strpos($file, '.php') > 0))
						{
							require $directory."/".$file;
						}
					}
				}
				closedir ($dir);
			}
		}
		if(ISSET($modules['templates']))
			if($tpl = $modules['templates']->get_var('template'))
			{
				$tpl->smarty() ->assign('LANG', $this->data);
			}
	}
	/*! translate
	 * \params
	 * - text - source text
	 * \return translated text
	 */
	public function translate($text)
	{
		if(ISSET($this->data[$text]))
			return $this->data[$text];
		return $text;
	}
}
?>
