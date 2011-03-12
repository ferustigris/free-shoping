<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->data['my orders list'] = 'Мои заказы';
	$this->data['orders list'] = 'Заказы';
	$this->data['Your are wait'] = 'К Вам уже мчатся';

	$this->data['Order from'] = 'Заказ от';
	$this->data['Total price'] = 'на сумму';
?>