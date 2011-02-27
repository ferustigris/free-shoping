<?php
	include_once "include/iface.user.php";
	include_once "libs/class.dynamiclist.php";
	include_once "libs/class.cookies.php";
	//! class for user
	class UserImpl extends DynamicList
	{
		private $id;//! id of user
		private $name;// name of user
		private $passwd;// passwd of user
		private $priority;//! priority of the user
		/*! create user
		 * \params no
		 * \return no
		 */
		public function __construct($un, $up)
		{
			global $db;
			$this->priority = AUTH_NOBODY;//nobody
			$this->id = -1;//nobody
			$this->name = $un;
			$result = $db->query("SELECT id, s_name, i_priority FROM ".$db->getPrefix()."users WHERE s_name = '".$this->name."' and s_passwd = '".$up."';");
			if($result)
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$this->id = $line[0];
					$this->name = $line[1];
					$this->priority = $line[2];
				}
			}
			parent::__construct("user_options", $this->id);
		}
		/*! create user
		 * \params no
		 * \return no
		 */
		public function __destruct()
		{
		}
		/*! get user prioruty
		 * \params no
		 * \return no
		 */
		public function priority()
		{
			return $this->priority;
		}
		/*! get user name
		 * \params no
		 * \return no
		 */
		public function name()
		{
			return $this->name;
		}
		/*! get user id
		 * \params no
		 * \return no
		 */
		public function id()
		{
			return $this->id;
		}
		/*! выход и прикончить сессию
		 * \params no
		 * \return no
		 */
		public function logout()
		{
			session_destroy();    //удаляем текущую сессию
		}
		/*! create new user
		 * \params
		 * - login - new login
		 * - passwd - password
		 * - priority - user priority
		 * \return User class or NULL
		 */
		static public function new_user($login, $password, $priority)
		{
			global $db;
			iF(!ISSET($db))return false;
			$result = $db->query("SELECT COUNT(*) FROM ".$db->getPrefix()."users WHERE s_name = '".$login."';");
			if($result)
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					if($line[0] > 0 )
					{
						return NULL;
					}
				}
			}
			//created user not exists
			if ($db->query("INSERT INTO ".$db->getPrefix()."users(i_priority, s_name, s_passwd) VALUES(".$priority.", '".$login."', '".$password."');"))
			{
				return new UserImpl($login, $password);;
			}
			return NULL;
		}
		/*! get all users
		 * \params no
		 * \return Users list
		 */
		public function users()
		{
			global $db;
			$users = Array();
			$result = $db->query("SELECT s_name, s_passwd FROM ".$db->getPrefix()."users WHERE i_priority > ".$this->priority.";");
			if($result)
			{
				while( $line = mysql_fetch_array( $result ) )
				{
					$users[] = new UserImpl ($line[0], $line[1]);
				}
			}
			return $users;
		}
		/*! change password
		 * \params
		 * - new_password - new password
		 * \return yes/no
		 */
		public function change_password($new_password)
		{
			global $db;
			if($db->query("UPDATE ".$db->getPrefix()."users
			SET s_passwd='".$new_password."'
			WHERE
			id=".$this->id.";"))
			{
				return true;
			}
			return false;
		}
		/*
		//remove user
		public function removeUser($id)
		{
			global $db;
			global $log;
			log (LOG_DEBUG, "AUTH: remove user");
			if ($db->query("DROP FROM ".$db->getPrefix()."users WHERE id=".$id." AND i_priority < ".$this->priority.";"))
			{
				if ($db->query("DROP FROM ".$db->getPrefix()."user_options WHERE i_link=".$id.";"))
					return true;
			}
			return false;
		}
		*/
	}
?>
