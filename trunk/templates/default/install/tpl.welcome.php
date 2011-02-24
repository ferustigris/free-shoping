<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:date="http://exslt.org/dates-and-times" lang="ru" xml:lang="ru">
	<head>
	</head>
	<body>
		<h1>Welcome!</h1>
		<h3>language select</h3>
		<form method="post" name='language_select' action='index.php?page=db_options'>
		    <input id="root" type="text" name="root" value="/var/www/cms/" />
			<select size=1 name="language">
			  <option <?php if($settings->get('language') == 'english')echo 'selected' ?> >english</option>
			  <option <?php if($settings->get('language') == 'russian')echo 'selected' ?> >russian</option>
			</select>
		    <input id="next" type="submit" name="next" value="Next" />
		</form>
	</body>
</html>
