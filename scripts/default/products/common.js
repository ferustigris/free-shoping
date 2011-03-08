jQuery(function() {
	setProductIcons();
	//setProductEditor();
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
	if(jQuery('.edit_button'))
		jQuery('.edit_button').button({
			icons: {
                primary: "ui-icon-wrench"
            }
		});
	if(jQuery('.remove_button'))
		jQuery('.remove_button').button({
			icons: {
	            primary: "ui-icon-closethick"
	        }
		});
	if(jQuery('.add_button'))
		jQuery('.add_button').button({
			icons: {
	            primary: "ui-icon-plusthick"
	        }
		});
	if(jQuery('.back'))
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
		$target = $( event.target );
		viewLargerImage( $target );
		return false;
	});
	$("select.product_childs_products_item_param").change(function( ) {
		$(this).parent().attr('selected', '0');
		$(this).parent().click();
	}) ;
	$("input.product_childs_products_item_param").mouseup(function(event ) {
		//$(this).parent().click() ;
		if($(this).attr("checked") == true){
			$(this).attr("checked", false);
			//alert(event.result);
		} else {
			$(this).attr("checked", true);
			//alert(event.result);
		}
		event.result = false;
		calcCommonPrice();
		return false;
	}) ;
	$(".product_childs_products_item") .click(function( ) {
		if($(this).attr('selected') == '0')
		{
			$(this).addClass("selected");
			$(this).attr('selected', '1');
			$(this).contents("div").each(function() {
				$(this).contents(":input").each(function() {
					$(this).attr("checked", true);
				});
			});
		} else {
			$(this).removeClass("selected");
			$(this).attr('selected', '0');
			$(this).contents("div").each(function() {
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
/*! set cool editor
 * \params no
 * \return no
 */
window.onload = function()
{
	CKEDITOR.replace( 'product_description',
			{
				customConfig : 'scripts/ckeditor/config.js'
			});
};
/*! remove size ajax
 * \params
 * - id - id size
 * \return no
 */
function onRemoveSizeClick(id) {	
	jQuery.get("index.php?module=products&action=size_remove&size_id=" + id,{},
		function(data) 
			{
				errors = jQuery('#errors', data);
				jQuery('#top_page').empty() ;
				jQuery('#top_page').append(errors.html());
				if(errors.html().indexOf('div') < 0)
				{
					jQuery('#size_item_'+id).hide() ;
				}
			});
	return false;
}
/*! add size ajax
 * \params no
 * \return no
 */
function onAddSizeClick() {	
		jQuery.post("index.php?module=products&action=size_save",{
			size_name: jQuery("#size_name") .attr("value")
		},
		function(data) 
		{
			content = jQuery("#content", data);
			errors = jQuery("#errors", data);
			jQuery('#sizes_list').append(content.html());
			jQuery('#top_page').empty() ;
			jQuery('#top_page').append(errors.html());
		});
	return false;
}
/*! remove Producer ajax
 * \params
 * - id - id size
 * \return no
 */
function onRemoveProducerClick(id) {	
	jQuery.get("index.php?module=products&action=producer_remove&producer_id=" + id,{},
		function(data) 
			{
				errors = jQuery('#errors', data);
				jQuery('#top_page').empty() ;
				jQuery('#top_page').append(errors.html());
				if(errors.html().indexOf('div') < 0)
				{
					jQuery('#producer_item_'+id).hide() ;
				}
			});
	return false;
}
/*! add Producer ajax
 * \params no
 * \return no
 */
function onAddProducerClick() {	
		jQuery.post("index.php?module=products&action=producer_save",{
			producer_name: jQuery("#producer_name") .attr("value"),
			product_description: jQuery("#product_description") .text()
		},
		function(data) 
		{
			content = jQuery("#content", data);
			errors = jQuery("#errors", data);
			jQuery('#producers_list').append(content.html());
			jQuery('#top_page').empty() ;
			jQuery('#top_page').append(errors.html());
		});
	return false;
}
/*! remove Material ajax
 * \params
 * - id - id Material
 * \return no
 */
function onRemoveMaterialClick(id) {	
	jQuery.get("index.php?module=products&action=material_remove&material_id=" + id,{},
		function(data) 
			{
				errors = jQuery('#errors', data);
				jQuery('#top_page').empty() ;
				jQuery('#top_page').append(errors.html());
				if(errors.html().indexOf('div') < 0)
				{
					jQuery('#material_item_'+id).hide() ;
				}
			});
	return false;
}
/*! add Material ajax
 * \params no
 * \return no
 */
function onAddMaterialClick() {	
		jQuery.post("index.php?module=products&action=material_save",{
			material_name: jQuery("#material_name") .attr("value"),
			product_description: jQuery("#product_description") .text()
		},
		function(data) 
		{
			content = jQuery("#content", data);
			errors = jQuery("#errors", data);
			jQuery('#materials_list').append(content.html());
			jQuery('#top_page').empty() ;
			jQuery('#top_page').append(errors.html());
		});
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
	jQuery('#form_remove_product').html(msg);
	jQuery('#form_remove_product').dialog({
		resizable: false,
		height:200,
		modal: true,
		buttons: {
			'ok': function() {
				jQuery( this ).dialog( "close" );
				jQuery.get('index.php?module=products&action=product_remove&product_id=' + id,{},function() {
					onCategoryChange(category_id);					
				});
				//document.getElementById('#form_remove_product').style.visibility = 'hidden';
			},
			'Отмена': function() {
				jQuery( this ).dialog( "close" );
				//document.getElementById('#form_remove_product').style.visibility = 'hidden';
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
	jQuery('#main_page').empty();
	jQuery('#main_page').empty();
	jQuery.post("index.php?module=products&page=product_page&product_id=" + id_product + "&category_id=" + id_category,{
		//producer_name: jQuery("#producer_name") .attr("value"),
		//product_description: jQuery("#product_description") .text()
	},
	function(data) 
	{
		content = jQuery("#content", data);
		errors = jQuery("#errors", data);
		jQuery('#main_page').append(content.html());
		jQuery('#top_page').empty() ;
		jQuery('#top_page').append(errors.html());
		setBasketIcons() ;
		selectableChildProduct();
		setProductIcons();
	});
	return false;
}
