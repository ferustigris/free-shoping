<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->data['buy'] = 'В корзину!';
	$this->data['Confirm!'] = 'Корзина';
	$this->data['confirm ok'] = 'Купить';//No enought actual products!
	$this->data['No enought actual products!'] = 'В корзине ничего нет!';//
	$this->data['remove from basket'] = 'Убрать из корзины';//No enought actual products!


	$this->data['modules/basket/tpl.basket.html'] = 'Корзина';
	$this->data['Click double to remove'] = 'Двойной щелчек для удаления';
	$this->data['Product has been in cart. Add double product?'] = 'Выбранный товар уже находится в корзине. Добавить еще один экземпляр?';

	$this->data['You not select anythink!'] = 'Вы ничего не выбрали!';
	$this->data['Products in basket: '] = 'Товаров в корзине: ';
	$this->data["Can't add product! No enougth actual parameters?"] = "Товар не добавлен! Не выбрано ни одного товара...";

	$this->data['Confirmation form'] = 'Корзина';
	$this->data['total price'] = 'Всего';
	$this->data['your choose'] = 'Вы выбрали';
	$this->data['your basket is empty'] = 'Ваша корзина пуста!';


?>