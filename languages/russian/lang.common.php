<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->data['title'] = 'Территория свободы';
	$this->data['Enter your name'] = 'Введите логин';
	$this->data['Your can not view page'] = 'Вы не имеете права на просмотр';
	$this->data['Can not open fields!'] = 'Не все поля заполнены!';
	$this->data['Warning!'] = 'Осторожно!';
	$this->data['Attention!'] = 'Внимание!';
	$this->data['ok'] = 'Ok';
	$this->data['cancel'] = 'Отмена';
	$this->data['JS'] = 'Скрипты';
	$this->data['not work'] = 'отключены';
	$this->data['recomended turn on'] = 'Рекомендуем включить.';
	$this->data['We in'] = 'Мы в';
	$this->data['vkontakte'] = 'контакте';
	$this->data['Write to us'] = 'Пишите нам';
	$this->data['Call us'] = 'Звоните нам';
?>
