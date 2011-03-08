<?php
include_once "include/iface.list.php";
include_once "libs/class.entry.php";
//! class for manage setting from local file
class Settings extends SimpleList {
	private $filename;
	private $data;
	/*! constructor
	 * \params
	 * - filename - name of file
	 * \return no
	 */
	public function __construct($filename)
	{
		$this->filename = $filename;
		$this->load();
	}
	/*! destructor
	 * \params no
	 * \return value
	 */
	public function __destruct()
	{
		$this->save();
	}
	/*! get value by filed name
	 * \params
	 * - filed - filed name
	 * \return value
	 */
	public function get($field)
	{
		if(ISSET($this->data[$field]) )
			return urlencode($this->data[$field]->value());
		return NULL;
	}
	/*! set value
	 * \params
	 * - filed - filed name
	 * - value - value
	 * \return no
	 */
	public function set($field, $value)
	{
		$this->data[$field] = new Entry($field, urldecode($value));
	}
	/*! load settings
	 * \params no
	 * \return no
	 */
	private function load()
	{
		if(file_exists($this->filename) )
			require $this->filename;
	}
	/*! save settings
	 * \params no
	 * \return no
	 */
	private function save()
	{
		if($file = fopen($this->filename, "w"))
		{
			fputs($file, "<?php\n");
			foreach($this->data as $item)
			{
				fputs($file, "	\$this->data['".$item->field()."'] = new Entry('".$item->field()."', '".$item->value()."');\n");
			}
			fputs($file, "?>\n");
			fclose($file);
		}
	}
}
?>
