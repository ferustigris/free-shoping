<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->data['Registration'] = 'Регистрация';
	$this->data['Enter your name'] = 'Логин';
	$this->data['Enter your full name'] = 'Введите Ваше настоящее имя';
	$this->data['Enter'] = 'Войти';
	$this->data['Save'] = 'Сохранить';

	$this->data['Enter your phone'] = 'Телефон';
	$this->data['Enter your mail'] = 'Ваш E-mail';
	$this->data['Enter your address'] = 'Ваш адрес';

	$this->data['modules/auth/tpl.enter_form.html'] = 'Вход';

	$this->data['Authorisation form'] = 'Авторизация';
	$this->data['Registration form'] = 'Регистрация';
	$this->data['Edit form'] = 'Мои данные';
	$this->data['Users list'] = 'Пользователи';

	$this->data['login'] = 'Ваш логин';
	$this->data['new password'] = 'Новый пароль';
	$this->data['password'] = 'Пароль';
	$this->data['retype password'] = 'Проверка пароля';
	$this->data['address'] = 'Почтовый адрес(для доставки)';
	$this->data['phone'] = 'Телефон';
	$this->data['mail'] = 'Электронный адрес';
	$this->data['your full name'] = 'Ваше настоящее имя';
	$this->data['Change password'] = 'Изменение пароля';
	$this->data['logout'] = 'Выйти';
	$this->data['User added!'] = 'Вы зарегистрированы.';

	$this->data['for registration enter next data'] = 'Введите данные для регистрации:';
	$this->data['more than 3 symbol'] = 'не менее 3 символов';


?>