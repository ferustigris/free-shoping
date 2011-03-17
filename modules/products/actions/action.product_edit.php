<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/products/include/class.product.php');
	if(($name = $this->forms_post()->get('product_name'))&&
			($article = $this->forms_post()->get('product_article'))
		)
	{
		$description = $this->forms_post()->get('product_description');
		$id = intval($this->forms_post()->get('product_id'));
		$category = intval($this->forms_post()->get('product_category'));
		$product_price = intval($this->forms_post()->get('product_price'));
		if($product = new Product($this, $id))
		{
			$this->log(LOG_DEBUG, 'saving product...');
			//pictures
			$img_full = NULL;
			$small_img = NULL;
			if($img = $this->forms_files()->get('product_img'))
			{
				if(file_exists($img->path()))
				{
					$img_full = 'images/products/'.time() .'_'.basename($img->path()) .'.'.'jpg';
					$img_small = 'images/products/'.time() .'_'.basename($img->path()) .'_small.'.'jpg';
					$img->move($img_full) ;
					$this->log(LOG_TODO, 'image resize');
					if($small_img = $this->forms_files()->get('product_small_img'))
					{
						$small_img->move($img_small);
					} else {
						$img->copy($img_small, 200, 200);
						$small_img = $product->small_img();
					}
					$product->set('img_full', $img_full);
					$product->set('img_small', $img_small);
				} else {
					$this->log(LOG_ERROR, 'file image not loaded!');
				}
				//description
				$product->set('description', urldecode($description));
				//name
				$product->set('name', urldecode($name)) ;
				$product->set('article', urldecode($article) );
				$product->set_price($product_price) ;
				//materials
				if($id_material = $this->forms_post()->get('product_material'))
					$product->set_material($id_material) ;
				//producers
				if($id_producer = $this->forms_post()->get('product_producer'))
					$product->set_producer($id_producer) ;
				//sizes
				$product->remove_sizes();
				if($sizes = new Size($this, -1))
				{
					if($all_sizes = $sizes->all())
					{
						foreach($all_sizes as $size)
						{
							if($id = $this->forms_post()->get('size_'.$size->id()))
							{
								$product->add_size($id);
							}
						}
					}
				}
			} else
				$this->log(LOG_ERROR, 'file image not loaded!');
		}
		else
			$this->log(LOG_ERROR, 'Can not open fields!');
	}
	else
		$this->log(LOG_ERROR, 'Can not open fields!');
?>