<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->data['Save'] = 'Сохранить';
	$this->data['Hide'] = 'Скрыть';
	$this->data['trash pages'] = 'Корзина';
	$this->data['link template sections with module pages'] = 'Страницы сайта';
?>