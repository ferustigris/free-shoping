/*! set buttons icons
 * \params no
 * \return no
 */
jQuery(function() {
	jQuery('.edit_button').button({
			icons: {
                primary: "ui-icon-wrench"
            }
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
}) ;
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
	document.getElementById('form_remove_product').text = msg;
	jQuery('#form_remove_product').dialog({
		resizable: false,
		height:200,
		modal: true,
		buttons: {
			ok: function() {
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
	jQuery('#products_container').empty();
	jQuery('#categories_container').empty();
	jQuery.post("index.php?module=products&page=product_page&product_id=" + id_product + "&category_id=" + id_category,{
		//producer_name: jQuery("#producer_name") .attr("value"),
		//product_description: jQuery("#product_description") .text()
	},
	function(data) 
	{
		content = jQuery("#content", data);
		errors = jQuery("#errors", data);
		jQuery('#products_container').append(content.html());
		jQuery('#top_page').empty() ;
		jQuery('#top_page').append(errors.html());
		jQuery(function() {
			jQuery(function() {
				jQuery('.edit_button').button({
						icons: {
			                primary: "ui-icon-wrench"
			            }
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
				setBasketIcons() ;
			}) ;
			jQuery('.back').button({
					icons: {
		                primary: "ui-icon-arrowreturnthick-1-s"
		            }
			});
			onProductPageLoad() ;
		}) ;

	});
	return false;
}
function onProductPageLoad() {
	jQuery( "#selectable" ).selectable({
		stop: function() {
			var result = jQuery( "#select-result" ).empty();
			jQuery( ".ui-selected", this ).each(function() {
				var index = jQuery( "#selectable li" ).index( this );
				result.append( " #" + ( index + 1 ) );
			});
		}
	});
};
