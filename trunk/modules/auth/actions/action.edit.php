<?php
	$password1 = $this->forms_post()->get('password1');
	$password2 = $this->forms_post()->get('password2');
	$phone = $this->forms_post()->get('phone');
	$mail = $this->forms_post()->get('mail');
	$address = $this->forms_post()->get('address');
	$full_name = $this->forms_post()->get('full_name');
	if($user = $this->get_var('user'))
	{
		if($phone)$user->set('phone', urldecode($phone));
		if($mail)$user->set('mail', urldecode($mail));
		if($address)$user->set('address', urldecode($address));
		if($full_name)$user->set('full_name', urldecode($full_name));
		if($password1&&($password1 === $password2))$user->change_password(sha1($password1));

	} else $this->log(LOG_ERROR, 'Can not access to user object!');
?>