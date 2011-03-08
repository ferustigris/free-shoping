<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->addPage('my_orders', 100, 9999, 'my orders list', 1);
	$this->addPage('orders', 0, 999, 'orders list', 1);
	$this->addAction('make_order', 0, 10000, 'make order');
	$this->addAction('change_order', 0, 999, 'change order');
	global $db;
	if($db)
	{
		$db->query("INSERT INTO	".$db->getPrefix()."order_states(i_code, s_name) VALUES(10,'started');");
		$db->query("INSERT INTO	".$db->getPrefix()."order_states(i_code, s_name) VALUES(20,'accepted');");
		$db->query("INSERT INTO	".$db->getPrefix()."order_states(i_code, s_name) VALUES(30,'order');");
		$db->query("INSERT INTO	".$db->getPrefix()."order_states(i_code, s_name) VALUES(40,'delivery');");
		$db->query("INSERT INTO	".$db->getPrefix()."order_states(i_code, s_name) VALUES(99,'canceled');");
		$db->query("INSERT INTO	".$db->getPrefix()."order_states(i_code, s_name) VALUES(100,'finish');");
	}

?>