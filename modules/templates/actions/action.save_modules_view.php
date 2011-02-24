<?php
	if($tpl = $this->get_var('template'))
	{
		if($sections = $tpl->get_avaible_sections())
		{
			if($pages = $tpl->get_avaible_pages())
			{
				foreach($pages as $page)
				{
					$tpl->remove_page_in_section($page->id());
					if($sel = $this->forms_post()->get($page->name()))
					{
						if(ISSET($sections[$sel]))
							$tpl->set_page_in_section($sections[$sel]->id(), $page->id());
					}
				}
			}
		}
	}
?>