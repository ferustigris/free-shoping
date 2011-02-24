/*! set icons
 * \params no
 * \return no
 */
jQuery(function() {
	jQuery('.back').button({
			icons: {
                primary: "ui-icon-arrowreturnthick-1-s"
            }
	});
}) ;
/*! change category
 * \params
 *  - id - id category
 * \return no
 */
function onCategoryChange(id) 
{
	jQuery('#categories_container').empty() ;
	jQuery('#products_container').empty() ;
	//onProductChange(-1, id);
	jQuery.post("index.php?module=categories&page=categories_list&category_id=" + id,{
		//producer_name: jQuery("#producer_name") .attr("value"),
		//product_description: jQuery("#product_description") .text()
	},
	function(data) 
	{
		content = jQuery("#content", data);
		errors = jQuery("#errors", data);
		jQuery('#categories_container').append(content.html());
		jQuery('#top_page').empty() ;
		jQuery('#top_page').append(errors.html());
		jQuery(function() {
			jQuery('.back').button({
					icons: {
		                primary: "ui-icon-arrowreturnthick-1-s"
		            }
			});
		}) ;

	});
	return false;
};
