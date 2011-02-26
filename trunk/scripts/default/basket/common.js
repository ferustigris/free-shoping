/*! Создаем контейнеры корзины
 * \params no
 * \return no
 */
$(function() {
		
		if(!jQuery.cookie('basket_content') )
		{
			jQuery('#basket_show').hide();
			jQuery("#basket_container").hide() ;
		} else {
			jQuery("#count_in_basket").html(jQuery.cookie('basket_content').split(';').length-1);
		}
		setBasketIcons();
});
/*! удаляем элемент из корзины
 * \params no
 * \return no
 */
function onProductInBasketClicked(id) 
{
	jQuery('#' + id).remove();
	jQuery.cookie('basket_content', jQuery("#basket").html());
	if(!jQuery.cookie('basket_content') )
		jQuery('#basket_show').hide();
}
/*! Создаем контейнеры корзины
 * \params no
 * \return no
 */
function onBuy(id) 
{
	if(jQuery.cookie('basket_content'))
	{
		if(jQuery.cookie('basket_content').search('id_product=' + id + ',') > -1)
		{
			jQuery('#form_add_double_product').dialog({
				resizable: false,
				height:200,
				modal: true,
				buttons: {
					'ok': function() 
					{
						addProduct(id);
						jQuery( this ).dialog( "close" );
					},
					'Отмена': function() {
						jQuery( this ).dialog( "close" );
					}
				}
			});
			return false;
		}
	}
	addProduct(id);
	return false;
}
/*! add product to basket
 * \params
 * - id - id product
 * \return no
 */
function addProduct(id)
{
	var isSel = false;
	jQuery('div.product_childs_products_item').each(function() {
		if($(this) .attr('selected') == '1')
		{
			isSel = true;
		}
	});
	if(!isSel)
	{
		jQuery('#form_not_select_child').dialog({
			resizable: false,
			height:200,
			modal: true,
			buttons: {
				'ok': function() 
				{
					jQuery( this ).dialog( "close" );
				}
			}
		});
	} else {
		if(!jQuery.cookie('basket_content') )
			jQuery.cookie('basket_content', '') ;
		jQuery.cookie('basket_content', jQuery.cookie('basket_content') + 'id_product=' + id + ',');
		jQuery('div.product_childs_products_item').each(function() {
			if($(this) .attr('selected') == '1')
			{
				jQuery.cookie('basket_content', jQuery.cookie('basket_content') + 'id_child=' + $(this) .attr('idchild') + ',');
			}
		});
		jQuery.cookie('basket_content', jQuery.cookie('basket_content') + ';');
		jQuery("#count_in_basket").html(jQuery.cookie('basket_content').split(';').length-1);
		jQuery('#basket_show').show();	
		jQuery('#basket_container').show();
	}
}
/*! set icons
 * \params no
 * \return no
 */
function setBasketIcons()
{
	jQuery('.buy').button({
		icons: {
	        primary: "ui-icon-cart"
	    }
	});
	jQuery('#basket_show').button({
		icons: {
	        primary: "ui-icon-check"
	    }
	});
}
/*! user want confirm his order
 * \params no
 * \return no
 */
function onConfirm()
{
	jQuery.post("index.php?module=basket&page=confirm",{
		//id_product: id
		//jQuery("#size_name") .attr("value")
		},
		function(data) 
		{
			content = jQuery("#content", data);
			errors = jQuery("#errors", data);
			jQuery('#top_page').empty() ;
			jQuery('#top_page').append(errors.html());
			jQuery.cookie('basket_content', "");
			jQuery('#basket').empty();
			jQuery('#main_page').html(content.html());
			jQuery('#basket_show').hide();
			accordion('basket_confirm_products');//
			alert(jQuery('#basket_confirm_products').html());			
	});
	//
	return false;
}
/*! accordion
 * \params
 * - id - id element for accordion
 * \return no
 */
function accordion(id) 
{
	var stop = false;
	$( "#" + id + " h3" ).click(function( event ) {
		if ( stop ) {
			event.stopImmediatePropagation();
			event.preventDefault();
			stop = false;
		}
	});
	$( "#" + id ).accordion({
		collapsible: true,
		active: false,
		//clearStyle: true,
		header: "h3"
	}).sortable({
		//axis: "y",
		//handle: "h3",
		connectWith: ".connected_basket",
		dropOnEmpty: true,
		stop: function() {
			stop = true;
		}
	})
	.disableSelection();
};
