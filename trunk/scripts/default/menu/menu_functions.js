/*! load new page by ajax
 * \params
 *  - page - new page
 * \return no
 */
function loadAjaxPage(page) 
{
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
	});
	return false;
}
