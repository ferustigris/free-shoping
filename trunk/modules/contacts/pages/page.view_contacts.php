<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once("modules/contacts/include/class.message.php");
	if($message = new MessageBody($this, -1))
		$this->assign('messages', $message->child());
	$this->assign('icq', $this->options()->get('icq'));
	$this->assign('phone', $this->options()->get('phone'));
	$this->assign('address', $this->options()->get('address'));
	$this->assign('email', $this->options()->get('email'));
	$this->assign('name', $this->options()->get('name'));

	$this->add_tpl('edit_contacts');
	$this->add_ajax_tpl('edit_contacts');
?>