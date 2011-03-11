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
	$(".connectedSortableSections" ).sortable({
		connectWith: ".connectedSortableSections",
		items: "li:not(.ui-state-disabled)"
	}).disableSelection();
	if(jQuery('#tpl_modules_view_save_button'))
	{
		jQuery('#tpl_modules_view_save_button').button({
			icons: {
	            primary: "ui-icon-check"
	        }
		});
		jQuery('#tpl_modules_view_save_button').click(function() {
			var line = {};
			//var params = [];
			$( ".connectedSortableSections" ).each(function(){
				var section = $(this).attr("id");
				var index = 1;
				$(this).contents(".ui-state-page").each(function() {
					line[$(this).html()] = section;
					line["sort_" + $(this).html()] = index;//sortable
					index++;
					//params[$(this).html()] = section;
				});
			});
			jQuery.post("index.php?module=templates&action=save_modules_view&page=edit_modules_view", line,
			function(data) 
			{
				//insertInPage(data);
				//alert(data);
				//jQuery('#main_page').append(content.html());
				//runTemplateModule();
				window.location = "index.php";
			});
			return false;
		});
	}
}

