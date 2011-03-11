<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	foreach($_POST as $v => $k)
	$this->log(LOG_DEBUG, $v.' - '.$k);
	$this->log(LOG_DEBUG, "save modules view");
	if($tpl = $this->get_var('template'))
	{
		if($sections = $tpl->get_avaible_sections())
		{
			if($pages = $tpl->get_avaible_pages())
			{
				foreach($pages as $page)
				{
					$tpl->remove_page_from_section($page->id());
					$this->log(LOG_DEBUG, "Remove page=".$page->name().":".urldecode($this->forms_post()->get('menu')));
					if($sel = $this->forms_post()->get($page->name()))
					{
						$sel = urldecode($sel);
						$this->log(LOG_DEBUG, "adding page ".$page->name()." in ".$sel."...");
						if(ISSET($sections[$sel]))
						{
							$sort_index = $this->forms_post()->get("sort_".$page->name());
							if($sort_index)
								$sort_index = intval(urldecode($sort_index));
							else
								$sort_index = 0;
							$tpl->set_page_in_section($sections[$sel]->id(), $page->id(), $sort_index);
							$this->log(LOG_DEBUG, "Add page=".$page->name().", section=".$sections[$sel]->name());
						}
					}
				}
			} else $this->log(LOG_ERROR, "No avaible pages!");
		} else $this->log(LOG_ERROR, "No avaible sections!");
	} else $this->log(LOG_ERROR, "No run template module!");
?>