/*! load new page by ajax
 * \params
 *  - page - new page
 * \return no
 */
function loadAjaxPage(page) 
{
	$.ajaxSetup({
		scriptCharset: "utf-8"
		});
	jQuery.cookie('redirect', page);
	hideMainSection();
	jQuery.post(page,{},
	function(data) 
	{
		setTimeout(function() 
		{
			insertInPage(data);
			onConfirmStart();
			setProductIcons();
			onCategoryStart();
			runTemplateModule();
			onAuthLoad();
			setContatcsIcons();
			setBasketIcons() ;
			selectableChildProduct();
			setProductIcons();
		},	500);
	});
	return false;
}
/*! load remember page
 * \params no
 * \return no
 */
jQuery(function() {
	url = jQuery.cookie('redirect');
	jQuery.cookie('redirect', '');
	if(url)
	{
		jQuery('#main_page').html('');
		loadAjaxPage(url);
	}
	$.ajaxSetup({
		scriptCharset: "utf-8"
	});
});
