jQuery(function() {
	setProductIcons();
	//setProductEditor();
	selectableChildProduct();
});
/*! set cool editor
 * \params no
 * \return no
 */
function setProductEditor() 
{
	if(jQuery('#product_description'))
		CKEDITOR.replace( 'product_description',
		{
			customConfig : 'scripts/ckeditor/config.js'
		});
}
/*! set buttons icons
 * \params no
 * \return no
 */
function setProductIcons() {
	jQuery('.edit_button').button({
		icons: {
               primary: "ui-icon-wrench"
		}
	});
	jQuery('.save_button').button({
		icons: {
               primary: "ui-icon-check"
		}
	}).click(function() {
		jQuery.cookie('redirect','');
		return true;
	});
	jQuery('.remove_button').button({
			icons: {
	            primary: "ui-icon-closethick"
	        }
	});
	jQuery('.add_button').button({
			icons: {
	            primary: "ui-icon-plusthick"
	        }
	});
	jQuery('.back').button({
			icons: {
	            primary: "ui-icon-arrowreturnthick-1-s"
	        }
	});
};
/*! select for child products
 * \params no
 * \return no
 */
function selectableChildProduct() 
{
	//resolve the icons behavior with event delegation
	if(jQuery('#product_js_to_basket'))
		jQuery('#product_js_to_basket').removeClass("hidden");
	$( "a.child_product_list_item_img" ).click(function( event ) {
		viewLargerImage($(this));
		return false;
	});
	$("select.product_childs_products_item_param").change(function( ) {
		$(this).parent().attr('selected', '0');
		$(this).parent().click();
	}) ;
	$("input.product_childs_products_item_param").mouseup(function(event ) {
		if($(this).attr("checked") == true){
			$(this).attr("checked", false);
		} else {
			$(this).attr("checked", true);
		}
		event.result = false;
		calcCommonPrice();
		return false;
	}) ;
	$(".product_childs_products_item") .click(function( ) {
		if($(this).attr('selected') == '0')
		{
			$(this).addClass("selected")
			.attr('selected', '1')
			.contents("div")
			.each(function() {
				$(this).contents(":input").each(function() {
					$(this).attr("checked", true);
				});
			});
		} else {
			$(this).removeClass("selected")
			.attr('selected', '0')
			.contents("div").each(function() {
				$(this).contents(":input").each(function() {
					$(this).attr("checked", false);
				});
			});
		}
		calcCommonPrice();
		return false;
	});
	return false;
};
function calcCommonPrice() {
	var price = 0;
	jQuery('div.product_childs_products_item').each(function() {
		if($(this).attr('selected') == '1')
		{
			price = price + parseInt($(this).attr('price'));
		};
		jQuery("#product_price_common").html(price);
	});	
}
/*! remove size ajax
 * \params
 * - id - id size
 * \return no
 */
function onRemoveSizeClick(id) {
	loadAjaxPage("index.php?module=products&action=size_remove&page=size_add&size_id=" + id);
	return false;
}
/*! add size ajax
 * \params no
 * \return no
 */
function onAddSizeClick() {	
	line = {size_name: jQuery("#size_name") .attr("value")}; 
	loadAjaxPage("index.php?module=products&action=size_save&page=size_add", line);
	return false;
}
/*! remove Producer ajax
 * \params
 * - id - id size
 * \return no
 */
function onRemoveProducerClick(id) {	
	loadAjaxPage("index.php?module=products&page=producer_add&action=producer_remove&producer_id=" + id);
	return false;
}
/*! add Producer ajax
 * \params no
 * \return no
 */
function onAddProducerClick() {	
	line = {
			producer_name: jQuery("#producer_name") .attr("value"), 
			product_description: jQuery("#product_description") .text()
	}
	loadAjaxPage("index.php?module=products&page=producer_add&action=producer_save", line);
	return false;
}
/*! remove Material ajax
 * \params
 * - id - id Material
 * \return no
 */
function onRemoveMaterialClick(id) {	
	loadAjaxPage("index.php?module=products&page=material_add&action=material_remove&material_id=" + id);
	return false;
}
/*! add Material ajax
 * \params no
 * \return no
 */
function onAddMaterialClick() {	
	var line = {
			material_name: jQuery("#material_name") .attr("value"), 
			product_description: jQuery("#product_description") .text()
	}
	loadAjaxPage("index.php?module=products&page=material_add&action=material_save", line);
	return false;
}
/*! remove product?
 * \params 
 * - ok - да
 * - no - cancel
 * - id - product id
 * - category_id - id category
 * - msg - message text
 * \return no
 */
function onRemoveProduct(ok, no, id, category_id, msg) {	
	jQuery('#form_remove_product').html(msg).dialog({
		resizable: false,
		height:200,
		modal: true,
		buttons: {
			'ok': function() {
				jQuery( this ).dialog( "close" );
				jQuery.get('index.php?module=products&action=product_remove&product_id=' + id,{},function() {
					onCategoryChange(category_id);					
				});
			},
			'Отмена': function() {
				jQuery( this ).dialog( "close" );
			}
		}
	});
	return false;
}
/*! change product
 * \params
 *  - id_product - id product
 *  - id_category - id category
 * \return no
 */
function onProductChange(id_product, id_category) 
{
	loadAjaxPage("index.php?module=products&page=product_page&product_id=" + id_product + "&category_id=" + id_category);
	return false;
}
