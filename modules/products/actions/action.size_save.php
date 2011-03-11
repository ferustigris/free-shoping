<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/products/include/class.size.php');
	if($mat = new Size($this, -1))
	{
		if($name = $this->forms_post()->get('size_name'))
		{
				if($new_size = $mat->add($name))
				{
				} else
					$this->log(LOG_DEBUG, 'Can not adding size!');
		}
		else
			$this->log(LOG_ERROR, 'Can not open fields!');
	}
?>