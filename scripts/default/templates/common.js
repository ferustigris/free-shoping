/*! set sortable
 * \params no
 * \return no
 */
$(function() {
	runTemplateModule();

});
/*! set sortable
 * \params no
 * \return no
 */
function runTemplateModule() 
{
	$( ".connectedSortableSections" ).sortable({
		connectWith: ".connectedSortableSections",
		items: "li:not(.ui-state-disabled)"
	}).disableSelection();
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
			jQuery('#top_page').empty() ;
			jQuery('#top_page').append(errors.html());
			jQuery('#main_page').empty() ;
			jQuery('#main_page').append(content.html());
			runTemplateModule();
		});
		return false;
	});
}

