jQuery(function() {
	onCategoryStart();
});
/*! set icons
 * \params no
 * \return no
 */
function onCategoryStart() {
	jQuery('.add_button').button({
		icons: {
            primary: "ui-icon-plusthick"
        }
	});
	jQuery('.back').button({
			icons: {
                primary: "ui-icon-arrowreturnthick-1-s"
            }
	});
	/*jQuery("#category_save_form").submit(function() {
		jQuery('#main_page').empty() ;
		jQuery.post("index.php?module=categories&page=categories_list&action=category_save",{
			category_name : jQuery("#category_name") .attr("value"),
			product_description : CKEDITOR.instances.product_description.getData(),
			category_parent : jQuery("#category_parent option:selected") .val(),//$("#my_select option:selected").val();
			category_img : jQuery("#category_img") .val(),
			category_small_img : jQuery("#category_small_img") .val()
		},
		function(data) 
		{
			content = jQuery("#content", data);
			errors = jQuery("#errors", data);
			jQuery('#main_page').append(content.html());
			jQuery('#top_page').empty() ;
			jQuery('#top_page').append(errors.html());
			onCategoryStart();
		});
		return false;
	});*/	
};
/*! change category
 * \params
 *  - id - id category
 * \return no
 */
function onCategoryChange(id) 
{
	jQuery('#main_page').empty() ;
	//onProductChange(-1, id);
	jQuery.post("index.php?module=categories&page=categories_list&category_id=" + id,{
		//producer_name: jQuery("#producer_name") .attr("value"),
		//product_description: jQuery("#product_description") .text()
	},
	function(data) 
	{
		content = jQuery("#content", data);
		errors = jQuery("#errors", data);
		jQuery('#main_page').append(content.html());
		jQuery('#top_page').empty() ;
		jQuery('#top_page').append(errors.html());
		onCategoryStart();
	});
	return false;
};
