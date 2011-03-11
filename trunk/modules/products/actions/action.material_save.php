<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/products/include/class.material.php');
	if($mat = new Material($this, -1))
	{
		if(($name = $this->forms_post()->get('material_name'))&&
			($description = $this->forms_post()->get('product_description'))
			)
		{
				if($new_mat = $mat->add($name, $description))
				{

				} else {
					$this->log(LOG_DEBUG, 'Can not add material!');
				}
		}
		else
			$this->log(LOG_ERROR, 'Can not open fields!');
	}
?>