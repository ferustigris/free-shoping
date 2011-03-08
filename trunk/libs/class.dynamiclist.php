<?php
include_once "include/iface.list.php";
	//class of user
	class DynamicList extends SimpleList
	{
		private $table;
		private $link;
		public function __construct($table, $link)
		{
			$this->table = $table;
			$this->link = $link;
		}
		public function get($field)
		{
			global $db;
			$field = urldecode($field);
			$result = $db->query("SELECT s_value FROM ".$db->getPrefix().$this->table." WHERE i_link = '".$this->link."' AND s_field = '".$field."';");
			if($result)
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					return urldecode($line[0]);
				}
			}
			return "";
		}
		//выход и прикончить сессию
		public function set($field, $value)
		{
			global $db;
			$value = urlencode($value);
			$field = urlencode($field);
			$result = $db->query("SELECT COUNT(*) FROM ".$db->getPrefix().$this->table." WHERE i_link = ".$this->link." AND s_field='".$field."';");
			if($result)
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					if ($line[0] > 0)
					{
						$db->query("UPDATE ".$db->getPrefix().$this->table." set s_value='".$value."' where i_link=".$this->link." AND s_field='".$field."';");
						return true;
					}
				}
			}
			$db->query("INSERT INTO ".$db->getPrefix().$this->table."(i_link, s_field, s_value) VALUES(".$this->link.", '".$field."', '".$value."');");
		}
	}
?>
