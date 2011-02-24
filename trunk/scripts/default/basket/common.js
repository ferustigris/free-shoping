/*! Создаем контейнеры корзины
 * \params no
 * \return no
 */
$(function() {
		$( "#basket" ).sortable({
			connectWith: ".connectedSortable",
			dropOnEmpty: false
		}).disableSelection();
});
/*! удаляем элемент из корзины
 * \params no
 * \return no
 */
function onProductInBasketClicked(id) 
{
	jQuery('#' + id).detach();
}
/*! Создаем контейнеры корзины
 * \params no
 * \return no
 */
function onBuy(id) 
{
	jQuery.post("index.php?module=basket&action=add_product&page=confirm",{
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
			jQuery('#basket').append(content.html());
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
        primary: "ui-icon-key"
    }
	});
}
setBasketIcons();
