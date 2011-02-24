<?php
//! class for db access
class DataBase {
	private $db_name;
	private $prefix;
	private $db;
	private $con;
	private $user;
	private $passwd;
	/*! access to cookies
	 * \params no
	 * \return no
	 */
	public function __construct($_db_name, $_prefix, $_user, $_passwd) {
		$this->con = 0;
		$this->db_name = $_db_name;
		$this->prefix = $_prefix;
		$this->user = $_user;
		$this->passwd = $_passwd;
		$this->connect();
	}
	/*! destructor
	 * \params no
	 * \return value
	 */
	public function __destruct() 
	{
		$this->disconnect();
	}
	/*! get db name
	 * \params no
	 * \return value
	 */
	public function getDBName() 
	{
		return $this->db_name;
	}
	/*! connect to db
	 * \params no
	 * \return no
	 */
	private function connect() 
	{
		if($this->con)return;
		$this->db=mysql_connect('localhost:3306', $this->user, $this->passwd);
		$this->con = 1;
		mysql_select_db($this->db_name);
	}
	/*! disconnect from db
	 * \params no
	 * \return no
	 */
	private function disconnect() 
	{
		$this->con = 0;
		mysql_close();
	}
	/*! exec query
	 * \params
	 * - str - sql
	 * \return no
	 */
	public function query($str) 
	{
		if(!$this->con)return 0;
		return mysql_query($str);
	}
	/*! get prefix for table
	 * \params no
	 * \return no
	 */
	public function getPrefix() 
	{
		return $this->prefix;
	}
	/*! get free id from table
	 * \params
	 * - table - table name
	 * \return no
	 */
	public function getFreeID($table) 
	{
		if(!$this->con)return 0;
		if($result = $this->query("SELECT MAX(id) FROM `".$this->getPrefix().$table."`;")) 
		{
			$line = mysql_fetch_array( $result );
			return $line[0];
		}
		return 1;
	}
}
?>
