<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	$this->addPage('enter_form', 10000, 10000, 'Authorisation form', 0);
	$this->addPage('registration_form', 10000, 10000, 'Registration form', 0);
	$this->addPage('edit_form', 0, 9999, 'Edit form', 1);
	$this->addPage('users', 0, 99, 'Users list', 1);
	$this->addPage('logout', 0, 9999, 'For logout', 0);
	$this->addAction('enter', 0, 10000, 'Enter user');
	$this->addAction('logout', 0, 9999, 'logout');
	$this->addAction('registration', 0, 10000, 'Registration new user');
	$this->addAction('edit', 0, 9999, 'Edit user');
?>