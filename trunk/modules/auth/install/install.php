<?php
	$this->addPage('enter_form', 10000, 10000, 'Authorisation form');
	$this->addPage('registration_form', 0, 10000, 'Registration form');
	$this->addPage('edit_form', 0, 9999, 'Edit form');
	$this->addPage('users', 0, 99, 'Users list');
	$this->addAction('enter', 0, 10000, 'Enter user');
	$this->addAction('logout', 0, 9999, 'logout');
	$this->addAction('registration', 0, 10000, 'Registration new user');
	$this->addAction('edit', 0, 9999, 'Edit user');
?>