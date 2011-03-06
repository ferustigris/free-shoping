<?php
	include_once('modules/products/include/class.product.php');
	if(($name = $this->forms_post()->get('product_name'))&&
			($article = $this->forms_post()->get('product_article'))&&
			($description = $this->forms_post()->get('product_description'))&&
			($parent = $this->forms_post()->get('product_parent'))&&
			($category = $this->forms_post()->get('product_category'))&&
			($product_price = $this->forms_post()->get('product_price') != NULL)
			)
	{
		$this->log(LOG_DEBUG, 'saving product...');
		if($img = $this->forms_files()->get('product_img'))
		{
			if(file_exists($img->path()))
			{
				if($product = new Product($this, $parent))
				{
					//pictures
					$img_full = 'images/products/'.time() .'_'.basename($img->path()) .'.'.'jpg';
					$img_small = 'images/products/'.time() .'_'.basename($img->path()) .'_small.'.'jpg';
					$img->move($img_full) ;
					$this->log(LOG_TODO, 'image resize');
					if($small_img = $this->forms_files()->get('product_small_img'))
					{
						$small_img->move($img_small);
					} else
						$img->copy($img_small, 200, 200) ;
					if($new_product = $product->add($category, $article, $name, $description, $img_full, $img_small))
					{
						//materials
						if($id_material = $this->forms_post()->get('product_material'))
							$new_product->set_material($id_material) ;
						//producers
						if($id_producer = $this->forms_post()->get('product_producer'))
							$new_product->set_producer($id_producer) ;
						$new_product->set_price($product_price) ;
							//sizes
						if($sizes = new Size($this, -1))
						{
							if($all_sizes = $sizes->all())
							{
								foreach($all_sizes as $size)
								{
									if($id = $this->forms_post()->get('size_'.$size->id()))
									{
										$new_product->add_size($id);
									}
								}
							}
						}
						if($parent > -1)
							$this->forms_get()->set('product_id', $parent);
						else
							$this->forms_get()->set('product_id', $new_product->id());
					} else
						$this->log(LOG_DEBUG, 'Can not add product!');
				}
				else
					$this->log(LOG_ERROR, 'Can not create object!');
			} else
				$this->log(LOG_ERROR, 'file image not loaded!');
		}
		else
			$this->log(LOG_ERROR, 'file image not loaded!');
	}
	else
		$this->log(LOG_ERROR, 'Can not open fields!');
?>