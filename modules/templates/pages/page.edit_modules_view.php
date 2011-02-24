<?php
	if($tpl = $this->get_var('template'))
	{
		$this->assign('sections', $tpl->get_avaible_sections());
		$this->assign('pages', $tpl->get_avaible_pages());
		$this->add_tpl('edit_modules_view');
	}
?>