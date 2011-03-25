<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once 'modules/faq/include/class.faq.php';
	if($faq = new FAQ($this, -1))
	{
		$faq->add($this->forms_post()->get('faq_question'), $this->forms_post()->get('faq_answer'));
	}
	$this->options()->set('icq', urldecode($this->forms_post()->get('icq')));
	$this->options()->set('phone', urldecode($this->forms_post()->get('phone')));
	$this->options()->set('address', urldecode($this->forms_post()->get('address')));
	$this->options()->set('email', urldecode($this->forms_post()->get('email')));
	$this->options()->set('name', urldecode($this->forms_post()->get('name')));
?>