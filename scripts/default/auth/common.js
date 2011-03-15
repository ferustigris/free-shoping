/*! set icons
 * \params no
 * \return no
 */
jQuery(function() {
	onAuthLoad();
});
/*! set icons
 * \params no
 * \return no
 */
function onAuthLoad() {
	jQuery('.save_button').button({
		icons: {
               primary: "ui-icon-key"
        }
	});
	if(jQuery('#registration_ok'))
		jQuery('#registration_ok').button({
			icons: {
	            primary: "ui-icon-key"
	        }
		}).attr('disabled',true);
	jQuery(".registration_valid_check").keyup(checkPassword);
	//if(jQuery('#registration_password1'))jQuery('#registration_password1').keyup(checkPassword);
	//if(jQuery('#registration_password2'))jQuery('#registration_password2').keyup(checkPassword);	
}
function checkPassword() {
	if(jQuery('#registration_password1').attr('value') != jQuery('#registration_password2').attr('value'))
			//||jQuery('#registration_password1').attr('value').length() < 3)
	{
		jQuery('#registration_password1').addClass("enter_error");
		jQuery('#registration_password2').addClass("enter_error");
		$('#registration_ok[type="submit"]').attr('disabled',true);
	} else
	{
		jQuery('#registration_password1').removeClass("enter_error");
		jQuery('#registration_password2').removeClass("enter_error");
		$('#registration_ok[type="submit"]').attr('disabled',false);
	}
}
