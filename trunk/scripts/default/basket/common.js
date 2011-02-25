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
			jQuery("#count_in_basket").html(jQuery.cookie('basket_content').split(';').length);
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
	if(jQuery.cookie('basket_content').search('id_product=' + id + ',') > -1)
		jQuery('#form_add_double_product').dialog({
			resizable: false,
			height:200,
			modal: true,
			buttons: {
				'ok': function() 
				{
					jQuery.cookie('basket_content', jQuery.cookie('basket_content') + 'id_product=' + id + ',;');
					jQuery("#count_in_basket").html(jQuery.cookie('basket_content').split(';').length);
					jQuery('#basket_show').show();
					jQuery( this ).dialog( "close" );
				},
				'Отмена': function() {
					jQuery( this ).dialog( "close" );
				}
			}
		});
	else
	{
		jQuery.cookie('basket_content', jQuery.cookie('basket_content') + 'id_product=' + id + ',;');
		jQuery("#count_in_basket").html(jQuery.cookie('basket_content').split(';').length);
		jQuery('#basket_show').show();
	}
	return false;
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
