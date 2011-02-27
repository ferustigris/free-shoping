/*! set sortable
 * \params no
 * \return no
 */
$(function() {
	setSortable();
	jQuery('.save_button').button({
		icons: {
            primary: "ui-icon-check"
        }
	});
	jQuery("#save_button").click(function() {
		var line = {};
		//var params = [];
		$( ".connectedSortableSections" ).each(function(){
			var section = $(this).attr("id");
			$(this).contents(".ui-state-page").each(function() {
				line[$(this).html()] = section;
				//params[$(this).html()] = section;
			});
		});
		//alert(line);
		//
		jQuery.post("index.php?module=templates&action=save_modules_view&page=edit_modules_view",
			line,
		function(data) 
		{
			content = jQuery("#content", data);
			errors = jQuery("#errors", data);
			jQuery('#materials_list').append(content.html());
			jQuery('#top_page').empty() ;
			jQuery('#top_page').append(errors.html());
		});
		return false;
	});
	
});
/*! set sortable
 * \params no
 * \return no
 */
function setSortable() 
{
	$( ".connectedSortableSections" ).sortable({
		connectWith: ".connectedSortableSections",
		items: "li:not(.ui-state-disabled)"
	}).disableSelection();
}

