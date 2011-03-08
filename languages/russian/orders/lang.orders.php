<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->data['my orders list'] = 'Мои заказы';
	$this->data['orders list'] = 'Заказы';
?>