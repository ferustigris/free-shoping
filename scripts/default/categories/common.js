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
};
/*! change category
 * \params
 *  - id - id category
 * \return no
 */
function onCategoryChange(id) 
{
	jQuery('#main_page').empty() ;
	jQuery.post("index.php?module=categories&page=categories_list&category_id=" + id,{
	},
	function(data) 
	{
		insertInPage(data);
		onCategoryStart();
	});
	return false;
};
