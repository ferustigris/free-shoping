<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/categories/include/class.category.php');
	if($category = new Category($this, -1))
	{
		if(($name = $this->forms_post()->get('category_name'))&&
			($description = $this->forms_post()->get('product_description'))&&
			($parent = intval($this->forms_post()->get('category_parent')))&&
			($img = $this->forms_files()->get('category_img'))
			)
		{
			if(file_exists($img->path()))
			{
				$this->log(LOG_DEBUG, 'saving category...');
				$img_full = 'images/categories/'.time() .'_'.basename($img->path()) .'.'.'jpg';
				$img_small = 'images/categories/'.time() .'_'.basename($img->path()) .'_small.'.'jpg';
				$img->move($img_full) ;
				$this->log(LOG_TODO, 'DANGER: image resize');
				if($small_img = $this->forms_files()->get('category_small_img'))
				{
					$small_img->move($img_small);
				} else
					$img->copy($img_small, 200, 200) ;
				if($ncategory = $category->add($parent))
				{
					$ncategory->set('name', urldecode($name));
					$ncategory->set('description', urldecode($description));
					$ncategory->set('img_full', urldecode($img_full));
					$ncategory->set('img_small', urldecode($img_small));
					$this->log(LOG_DEBUG, 'Category added');
				} else
					$this->log(LOG_DEBUG, 'Category not added');
			}
			else
				$this->log(LOG_ERROR, 'file image not loaded!');
		}
		else
			$this->log(LOG_ERROR, 'Can not open fields!');
	}
?>