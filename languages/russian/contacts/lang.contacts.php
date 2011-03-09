<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->data['Contacts'] = 'Наши контакты';
	$this->data['contacts'] = 'Контакты';
	$this->data['our email'] = 'Наша почта';
	$this->data['our address'] = 'Наш адрес';
	$this->data['our phone'] = 'Наш телефон';
	$this->data['my icq'] = 'ICQ';
	$this->data['callback'] = 'Обратная связь';
	$this->data['send'] = 'отправить';
	$this->data['You must authorized for write us...'] = 'Вы сможете оставить сообщение после того, как представитесь...';
?>