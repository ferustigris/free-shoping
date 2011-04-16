<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once 'modules/auth/include/class.user.php';
	//require_once 'modules/auth/include/LoginzaAPI.class.php';
	//require_once 'modules/auth/include/LoginzaUserProfile.class.php';
	//! save login and password to cookies session
	$this->log(LOG_DEBUG, 'action enter');
	$login = $this->forms_post()->get('login');
	$password = sha1($this->forms_post()->get('password'));
/*/###########################
	// объект работы с Loginza API
	$LoginzaAPI = new LoginzaAPI();
	// проверка переданного токена
	if (!empty($_POST['token']))
	{
		// получаем профиль авторизованного пользователя
		$UserProfile = $LoginzaAPI->getAuthInfo($_POST['token']);
		// проверка на ошибки
		if (!empty($UserProfile->error_type)) {
			// есть ошибки, выводим их
			// в рабочем примере данные ошибки не следует выводить пользователю, так как они несут информационный характер только для разработчика
			//echo $UserProfile->error_type.": ".$UserProfile->error_message;
		} elseif (empty($UserProfile)) {
			// прочие ошибки
			//echo 'Temporary error.';
		} else {
			// ошибок нет запоминаем пользователя как авторизованного
			$_SESSION['loginza']['is_auth'] = 1;
			// запоминаем профиль пользователя в сессию или создаем локальную учетную запись пользователя в БД
			$_SESSION['loginza']['profile'] = $UserProfile;
			// объект генерации недостаюих полей (если требуется)
			$LoginzaProfile = new LoginzaUserProfile($_SESSION['loginza']['profile']);
			$login = $LoginzaProfile->genNickname();
			$password = sha1($LoginzaProfile->genNickname());
		}
	}
//###########################*/




	if($login&&$password)
	{
		$this->sessions()->set('login', $login);
		$this->sessions()->set('password', $password);
	}
	if($user = new UserImpl($login, $password))
	{
		if($user->priority() >= AUTH_NOBODY)
		{
			if(!empty($_SESSION['loginza']['is_auth']))
			{
				if($user = $user->new_user($login, $password, AUTH_USER))
				{
					/*$LoginzaProfile = new LoginzaUserProfile($_SESSION['loginza']['profile']);
					$user->set('full_name', urldecode($LoginzaProfile->genFullName()));
					//if($phone)$user->set('phone', urldecode($phone));
					$user->set('mail', urldecode($LoginzaProfile->genUserSite()));
					//if($address)$user->set('address', urldecode($address));
					*/
				}
			}
			setcookie('redirect', '');
			$this->log(LOG_ERROR, "Login or password incorrect!");
		} else
		{
			$this->redirect("index.php");
		}
	}
?>