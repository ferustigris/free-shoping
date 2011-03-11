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
	jQuery('#main_page').empty();
	jQuery.post(page,{},
	function(data) 
	{
		insertInPage(data);
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
		scriptCharset: "utf-8"
		});
});
