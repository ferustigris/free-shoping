<?php
	include_once('modules/products/include/class.size.php');
	if($mat = new Size($this, -1))
	{
		if($name = $this->forms_post()->get('size_name'))
		{
				if($new_size = $mat->add($name))
				{
					$this->assign('new_size', $new_size);
					$this->add_ajax_tpl('size');
				} else
					$this->log(LOG_DEBUG, 'Can not adding size!');
		}
		else
			$this->log(LOG_ERROR, 'Can not open fields!');
	}
?>