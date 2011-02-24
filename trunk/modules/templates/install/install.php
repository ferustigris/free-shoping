<?php
	global $db;
	if(ISSET($db))
	{
		$db->query("INSERT INTO ".$db->getPrefix()."templates(s_name, s_description) VALUES('default','default template');");
		if($result = $db->query("SELECT id FROM ".$db->getPrefix()."templates WHERE s_name='default';"))
		{
			while( $line = mysql_fetch_array( $result ) )
			{
				$db->query("INSERT INTO ".$db->getPrefix()."tpl_sections(id_tpl, is_main, s_section)
				VALUES(".$line[0].",1,'main');");
				$db->query("INSERT INTO ".$db->getPrefix()."tpl_sections(id_tpl, is_main, s_section)
				VALUES(".$line[0].",0,'left');");
				$db->query("INSERT INTO ".$db->getPrefix()."tpl_sections(id_tpl, is_main, s_section)
				VALUES(".$line[0].",0,'right');");
				$db->query("INSERT INTO ".$db->getPrefix()."tpl_sections(id_tpl, is_main, s_section)
				VALUES(".$line[0].",0,'bottom');");
				$db->query("INSERT INTO ".$db->getPrefix()."tpl_sections(id_tpl, is_main, s_section)
				VALUES(".$line[0].",0,'top');");
				$db->query("INSERT INTO ".$db->getPrefix()."tpl_sections(id_tpl, is_main, s_section)
				VALUES(".$line[0].",0,'header');");
			}
		}

	}
	/*install default template*/
	/*$this->addPage('enter_form', 10000, 10000, 'Authorisation form');
	$this->addPage('registration_form', 0, 10000, 'Registration form');
	$this->addAction('enter', 0, 10000, 'Enter user');
	*/
	$this->addPage('edit_modules_view', 0, 100, 'link template sections with module pages');
	$this->addAction('save_modules_view', 0, 100, 'save modules pages') ;
?>