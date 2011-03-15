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
	var has_errors = false;
	if(/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/.test(jQuery('#registration_mail').attr('value')))
	{
		setCheck('mail');
	} else 	{
		setUncheck('mail');
		has_errors = true;
	}
	if((jQuery('#registration_login').attr('value').length > 0)&&(jQuery('#registration_login').attr('value').length < 20))
	{
		setCheck('login');
	} else 	{
		setUncheck('login');
		has_errors = true;
	}
	if(jQuery('#registration_phone').attr('value').length > 5)
	{
		setCheck('phone');
	} else 	{
		setUnheck('phone');
		has_errors = true;
	}
	if(jQuery('#registration_address').attr('value').length > 5)
	{
		setCheck('address');
	} else 	{
		setUnheck('address');
		has_errors = true;
	}
	if((jQuery('#registration_password1').attr('value').length > 2)&&(jQuery('#registration_password1').attr('value') == jQuery('#registration_password2').attr('value')))
	{
		setCheck('password1');
		setCheck('password2');
	} else
	{
		has_errors = true;
		setUncheck('password1');
		setUncheck('password2');
	}
	if(has_errors)
	{
		$('#registration_ok[type="submit"]').attr('disabled',true);
	} else {
		$('#registration_ok[type="submit"]').attr('disabled',false);
		jQuery('#registration_ok[type="submit"]').click(function() {
			jQuery.cookie('redirect', '');
			return true;
		})
	}
}
function setCheck(name) {
	jQuery('#registration_icon_' + name).removeClass('ui-icon-alert');
	jQuery('#registration_icon_' + name).addClass('ui-icon-check');
	jQuery('#registration_wrapper_' + name).removeClass('enter_error');
	jQuery('#registration_' + name).removeClass('enter_error');
};
function setUncheck(name) {
	jQuery('#registration_icon_' + name).addClass('ui-icon-alert');
	jQuery('#registration_icon_' + name).removeClass('ui-icon-check');
	jQuery('#registration_wrapper_' + name).addClass('enter_error');
	jQuery('#registration_' + name).addClass('enter_error');
};
