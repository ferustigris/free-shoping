jQuery(function() {
	onConfirmStart();
	onBasketStart();
});
/*! Создаем контейнеры списока заказов
 * \params no
 * \return no
 */
function onConfirmStart() {
		//setBasketIcons();
	if(jQuery('#basket_order_ok'))
		jQuery('#basket_order_ok').button({
			icons: {
		        primary: "ui-icon-arrowthick-1-e"
		    }
		}).click(function () {
			var line = {};
			jQuery('input').each(function(){
				line[$(this).attr('name')] = $(this).attr('value');
			});
			jQuery.post("index.php?module=orders&page=my_orders&action=make_order",line,
				function(data) 
				{
					content = jQuery("#content", data);
					errors = jQuery("#errors", data);
					jQuery('#top_page').empty();
					if(!content.html())
					{//no autorization!
						loadAjaxPage('index.php?module=auth&page=registration_form');
					}
					jQuery('#top_page').append(errors.html());
					jQuery('#main_page').html(content.html());
					if(!jQuery.cookie('basket_content'))
					{
						if(jQuery('#basket_show'))jQuery('#basket_show').hide();
						if(jQuery("#basket_container"))jQuery("#basket_container").hide() ;
					}
					onConfirmStart() ;
			});
			return false;
		});
	accordion("basket_confirm_products_list");
	jQuery('.remove_product_from_basket').click(function () {
		var par = $(this).parent().parent().parent();
		$(this).parent().parent().detach();
		var new_basket = '';
		par.contents('.confirm_one_product_container').each(function(){
			new_basket += 'id_product=' + $(this).attr('id_product') + ',';
			$(this).contents('.child_products_list_on_confirm_page').each(function(){
				$(this).contents('ul').each(function(){
					$(this).contents('li').each(function(){
						new_basket += 'id_child=' + $(this).attr('id_child') + ',';
						new_basket += 'id_size=' + $(this).attr('id_size') + ',';
					});
				});
			});
			new_basket += ';';
		});
		
		jQuery.cookie('basket_content', new_basket);
		//alert(jQuery.cookie('basket_content'));
		if(jQuery("#count_in_basket"))jQuery("#count_in_basket").html(jQuery.cookie('basket_content').split(';').length-1);
		var total_price = 0;
		$('.confirm_one_product_container').each(function(){
			total_price += parseInt($(this).attr('price'));
		});
		$('#total_price_container').html(total_price);
		accordion("basket_confirm_products_list");
	});
};
/*! Создаем контейнеры корзины
 * \params no
 * \return no
 */
function onBasketStart() {
	if(jQuery('#basket_show')&&jQuery("#basket_container"))
	{
		if(jQuery.cookie('basket_content'))
		{
				if(jQuery.cookie('basket_content').split(';').length < 2 )
				{
					jQuery('#basket_show').hide();
					jQuery("#basket_container").hide() ;
				} else {
					jQuery("#count_in_basket").html(jQuery.cookie('basket_content').split(';').length-1);
				}
		} else {
				jQuery('#basket_show').hide();
				jQuery("#basket_container").hide() ;
		};
		jQuery('#basket_show').button({
			icons: {
		        primary: "ui-icon-cart"
		    }
		});
	};
};
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
	var isSel = true;
	jQuery('div.product_childs_products_item').each(function() {
			isSel = false;
	});
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
		if(isCookies())
		{
			jQuery.cookie('basket_content', jQuery.cookie('basket_content') + 'id_product=' + id + ',');
			jQuery('div.product_childs_products_item').each(function() {
					if($(this).attr('selected') == '1')
					{
						jQuery.cookie('basket_content', jQuery.cookie('basket_content') + 'id_child=' + $(this) .attr('idchild') + ',');
						$(this).contents('div.product_params_2').each(function() {
							$(this).contents('select').each(function() {
								jQuery.cookie('basket_content', jQuery.cookie('basket_content') + 'id_size=' + $(this).val() + ',');
							}) ;
						}) ;
					}
			});
			jQuery.cookie('basket_content', jQuery.cookie('basket_content') + ';');
			jQuery("#count_in_basket").html(jQuery.cookie('basket_content').split(';').length-1);
			jQuery('#basket_show').show();
			jQuery('#basket_container').show();
		} else {
			var line = {};
			jQuery('input:hidden').each(function(){
				line[$(this).attr('name')] = $(this).val();
			});
			jQuery('input:checkbox:checked').each(function(){
				line[$(this).attr('name')] = $(this).attr('value');
			});
			jQuery('select').each(function(){
				line[$(this).attr('name')] = $(this).val();
				alert(3 + $(this).attr('name') + $(this).val());
			});
			jQuery.post("index.php?module=basket&page=confirm&action=add_product",
					line,
				function(data) 
				{
					content = jQuery("#content", data);
					errors = jQuery("#errors", data);
					jQuery('#top_page').empty();
					jQuery('#top_page').append(errors.html());
					jQuery('#main_page').html(content.html());
					if(!jQuery.cookie('basket_content'))
					{
						if(jQuery('#basket_show'))jQuery('#basket_show').hide();
						if(jQuery("#basket_container"))jQuery("#basket_container").hide() ;
					}
					onConfirmStart() ;
			});
		}
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
	        primary: "ui-icon-plusthick"
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
			jQuery('#basket').empty();
			jQuery('#main_page').html(content.html());
			onConfirmStart() ;
	});
	return false;
}
/*! accordion
 * \params
 * - id - id element for accordion
 * \return no
 */
function accordion(id) 
{
	if($( "#" + id ))
	$( "#" + id ).accordion({
		collapsible: true,
		active: false,
		autoHeight: true,
		clearStyle: true,
		header: "h3"
	}).disableSelection();
};
