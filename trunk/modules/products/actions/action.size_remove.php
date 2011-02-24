<?php
	include_once('modules/products/include/class.size.php');
	if($mat_id = $this->forms_get()->get('size_id')
			)
	{
		if($mat = new Size($this, $mat_id))
		{
			if(!$mat->remove())
				$this->log(LOG_ERROR, 'Can not remove size!');
		}
		else
			$this->log(LOG_ERROR, 'Can not create object!');
	}
	else
		$this->log(LOG_ERROR, 'Can not open fields!');
?>