/*! Создаем контейнеры корзины
 * \params no
 * \return no
 */
$(function() {
		jQuery("#basket").html(jQuery.cookie('basket_content'));
		if(!jQuery.cookie('basket_content') )
			jQuery('#basket_show').hide();
		setBasketIcons();
		accordion('basket') ;
		accordion('basket_for_copy') ;
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
	jQuery.post("index.php?module=basket&action=add_product&page=added_product",{
		id_product: id
		//jQuery("#size_name") .attr("value")
	},
	function(data) 
	{
		content = jQuery("#content", data);
		errors = jQuery("#errors", data);
		//jQuery('#sizes_list').append(content.html());
		jQuery('#top_page').empty() ;
		jQuery('#top_page').append(errors.html());
		new_id = 0;
		jQuery('.basket_element_clone').each(function(a,b) {
			if(parseInt(b.attr('id')) > new_id)
				new_id = parseInt(b.attr('id')) + 1;
		});
		if(jQuery('#item' + id).html())
			jQuery('#form_add_double_product').dialog({
				resizable: false,
				height:200,
				modal: true,
				buttons: {
					'ok': function() {
						jQuery( this ).dialog( "close" );
						count = parseInt(jQuery('#item' + id).attr('count')) + 1;
						jQuery('#item' + id).innerHTML = content.html();
						jQuery('#item' + id).attr('count', count);//basket_count_items_
						jQuery('#basket_count_items_' + id).html(count);//
					},
					'Отмена': function() {
						jQuery( this ).dialog( "close" );
					}
				}
			});
		else
		{
			jQuery('#basket_element_clone')
			.clone().appendTo(jQuery('#basket'))
			.attr('id', new_id).show();
		}
		jQuery.cookie('basket_content', jQuery('#basket').html());
		jQuery('#basket_element_clone')basket_container
		jQuery('#basket_show').show();
	});

	
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
