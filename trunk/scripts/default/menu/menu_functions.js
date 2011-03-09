/*! load new page by ajax
 * \params
 *  - page - new page
 * \return no
 */
function loadAjaxPage(page) 
{
	$.ajaxSetup({
		scriptCharset: "utf-8" ,
		contentType: "application/txt; charset=utf-8"
		});
	jQuery('#main_page').empty();
	jQuery.post(page,{},
	function(data) 
	{
		content = jQuery("#content", data);
		errors = jQuery("#errors", data);
		jQuery('#main_page').append(content.html());
		jQuery('#top_page').empty() ;
		jQuery('#top_page').append(errors.html());
		onConfirmStart();
		setProductIcons();
		onCategoryStart();
		runTemplateModule();
		onAuthLoad();
		//setProductEditor();
		setContatcsIcons();
	});
	return false;
}
jQuery(function() {
	url = jQuery.cookie('redirect');
	jQuery.cookie('redirect', '');
	if(url)
	{
		loadAjaxPage(url);
	}
	$.ajaxSetup({
		scriptCharset: "utf-8" ,
		contentType: "application/txt; charset=utf-8"
		});
});
