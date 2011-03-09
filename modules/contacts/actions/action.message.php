<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once("modules/contacts/include/class.message.php");
	if($body = $this->forms_post()->get('contacts_message'))
	{
		if($message = new MessageBody($this, -1))
		{
			$user_id = -1;
			if($mod_auth = $this->get_module('auth'))
				if($user = $mod_auth->get_var('user'))
					$user_id = $user->id();
			if($message->add(-1, $user_id, $body))
			{
				$this->log(LOG_NOTICE, "Your message received!");
			} else $this->log(LOG_ERROR, "Your message not received!");
		}
	} else $this->log(LOG_ERROR, "No message text!");
?>