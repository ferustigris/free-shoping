<?php
	include_once('modules/products/include/class.material.php');
	if($mat = new Material($this, -1))
	{
		if(($name = $this->forms_post()->get('material_name'))&&
			($description = $this->forms_post()->get('product_description'))
			)
		{
				if($new_mat = $mat->add($name, $description))
				{
					$this->assign('new_material', $new_mat);
					$this->add_ajax_tpl('material');
				} else {
					$this->log(LOG_DEBUG, 'Can not add material!');
				}
		}
		else
			$this->log(LOG_ERROR, 'Can not open fields!');
	}
?>