<?php
	$this->addPage('my_orders', 100, 9999, 'my orders list', 1);
	$this->addPage('orders', 0, 999, 'orders list', 1);
	$this->addAction('make_order', 100, 9999, 'make order');
	$this->addAction('change_order', 0, 999, 'change order');
?>