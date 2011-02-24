<?php
	include_once('modules/products/include/class.material.php');
	if($mat_id = $this->forms_get()->get('material_id'))
	{
		if($mat = new Material($this, $mat_id))
		{
			if(!$mat->remove())
				$this->log(LOG_ERROR, 'Can not remove material!');
		}
		else
			$this->log(LOG_ERROR, 'Can not create object!');
	}
	else
		$this->log(LOG_ERROR, 'Can not open fields!');
?>