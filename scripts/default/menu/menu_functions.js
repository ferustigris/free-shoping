/*! load new page by ajax
 * \params
 *  - page - new page
 * \return no
 */
function loadAjaxPage(page, line) 
{
	line = line || Array();
	if((line.length == 0)&&(jQuery.cookie('redirect') == page))
		return false;
	jQuery.cookie('redirect', page);
	hideMainSection();
	$.ajaxSetup({
		scriptCharset: "utf-8"
		});
	jQuery.post(page,
			line,
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
			onMenuStart();
			if(!isCookies())
				$( "#nocookies" ).show();
		},	300);
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
	onMenuStart();
});
/*! set links
 * \params no
 * \return no
 */
function onMenuStart() {
	jQuery(".ajax_link").each(function () {
		$(this).click(function() {
			loadAjaxPage($(this).attr('href'))
			return false;
		});
	});
};
