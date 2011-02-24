<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:date="http://exslt.org/dates-and-times" lang="ru" xml:lang="ru">
	<head>
	</head>
	<body>
		<h3>add user</h3>
		<form method="post" name="db_select" action="index.php?page=install_modules">
			<p>name</p>
		    <input class="" type="text" name="login" value="<?php echo $cook->get('login') ?>" />
			<p>password</p>
		    <input class="" type="password" name="password" value="" />
		    <input id="next" type="submit" name="next" value="Next" />
		</form>
	</body>
</html>
