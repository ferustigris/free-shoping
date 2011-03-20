<?php
	if(!ISSET($GLOBALS['INDEX'])) { header('Location: /index.php'); die(); }
	include_once('modules/categories/include/class.category.php');
	$id = -1;
	if($this->forms_get()->get('category_id'))
		$id = intval($this->forms_get()->get('category_id'));
	//$this->log(LOG_NOTICE, "SESS=".session_id().", id=".$id);
	if($category = new Category($this, $id))
	{
		$childs = $category->child();
		$this->assign('list2', $childs);
		$this->assign('id', $id);
		//foreach($childs as $c)$this->log(LOG_NOTICE, "SESS=".$c->get('name'));
		$parents = Array() ;
		$parent = $category->get_parent();
		while($parent->id() > -1)
		{
			$parents[] = $parent;
			$parent = $parent->get_parent();
		}
		$this->assign('parents_list', $parents);
		$this->add_tpl('categories_list');
		$this->add_ajax_tpl('categories_list');
		if($products = $this->get_module('products'))
		{
			$products->load('products_list');
		}
	}
?>