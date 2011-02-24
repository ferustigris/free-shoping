<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:date="http://exslt.org/dates-and-times" lang="ru" xml:lang="ru">
	<head>
	</head>
	<body>
		<h3>database options</h3>
		<form method="post" name="db_select" action="index.php?page=add_user">
			<p>db name</p>
		    <input class="" type="text" name="db_name" value="<?php echo $settings->get('db_name') ?>" />
			<p>table prefix</p>
		    <input class="" type="text" name="db_prefix" value="<?php echo $settings->get('db_prefix') ?>" />
			<p>db user</p>
		    <input class="" type="text" name="db_user" value="<?php echo $settings->get('db_user') ?>" />
			<p>db password</p>
		    <input class="" type="password" name="db_passwd" value="<?php echo $settings->get('db_passwd') ?>" />
		    <input id="next" type="submit" name="next" value="Next" />
		</form>
	</body>
</html>
