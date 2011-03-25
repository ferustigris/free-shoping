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
	$( "#tabs" ).tabs({
		collapsible: true
	});
	$(function() {
		$( "#seo_accordion" ).accordion({
			collapsible: true,
			active: false
	
		});
	});

};
/*! change category
 * \params
 *  - id - id category
 * \return no
 */
function onCategoryChange(id) 
{
	loadAjaxPage("index.php?module=categories&page=categories_list&category_id=" + id, {});
	return false;
};
