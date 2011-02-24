<?php
	$this->assign('users', $this->get_var('user')->users());
	$this->add_tpl('users_list');
?>