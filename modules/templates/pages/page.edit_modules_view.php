<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	if($tpl = $this->get_var('template'))
	{
		$this->assign('sections', $tpl->get_avaible_sections());
		$this->assign('pages', $tpl->get_avaible_pages());
		if($sect =  new Section(-1,'',''))
			$this->assign('free_pages', $sect->free_pages());
		$this->add_tpl('edit_modules_view');
		$this->add_ajax_tpl('edit_modules_view');
	}
?>