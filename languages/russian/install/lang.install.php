<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->data['modules list'] = 'Модули';
	$this->data['Installed modules'] = 'Установленные модули';
	$this->data['Install'] = 'Установить';
	$this->data['Uninstall'] = 'Удалить';
	$this->data['Install module'] = 'Модуль для установки';
?>
